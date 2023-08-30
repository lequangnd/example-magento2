<?php

namespace Dtn\Newsletter\Controller\Override\Newsletter\Subscriber;

use Magento\Customer\Api\AccountManagementInterface as CustomerAccountManagement;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\Session;
use Magento\Customer\Model\Url as CustomerUrl;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Phrase;
use Magento\Framework\Validator\EmailAddress as EmailValidator;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Controller\ResultFactory;
use Magento\Newsletter\Model\Subscriber;
use Magento\Newsletter\Model\SubscriberFactory;
use Magento\Newsletter\Model\SubscriptionManagerInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Validator\NotEmpty;

class NewAction extends \Magento\Newsletter\Controller\Subscriber\NewAction
{
    /**
     * Customer account management
     *
     * @var CustomerAccountManagement
     */
    protected $customerAccountManagement;

    /**
     * Name Validator
     *
     * @var NotEmpty
     */
    private $nameValidator;

    /**
     * Email validator
     *
     * @var EmailValidator|mixed
     */
    private $emailValidator;

    /**
     * Subscription manager
     *
     * @var SubscriptionManagerInterface
     */
    private $subscriptionManager;

    /**
     * Customer repository
     *
     * @var CustomerRepositoryInterface|mixed
     */
    private $customerRepository;

    /**
     * NewAction constructor.
     * @param Context $context
     * @param SubscriberFactory $subscriberFactory
     * @param Session $customerSession
     * @param StoreManagerInterface $storeManager
     * @param CustomerUrl $customerUrl
     * @param CustomerAccountManagement $customerAccountManagement
     * @param SubscriptionManagerInterface $subscriptionManager
     * @param NotEmpty $nameValidator
     * @param EmailValidator|null $emailValidator
     * @param CustomerRepositoryInterface|null $customerRepository
     */
    public function __construct(
        Context $context,
        SubscriberFactory $subscriberFactory,
        Session $customerSession,
        StoreManagerInterface $storeManager,
        CustomerUrl $customerUrl,
        CustomerAccountManagement $customerAccountManagement,
        SubscriptionManagerInterface $subscriptionManager,
        NotEmpty $nameValidator,
        EmailValidator $emailValidator = null,
        CustomerRepositoryInterface $customerRepository = null
    ) {
        parent::__construct
        (
            $context,
            $subscriberFactory,
            $customerSession,
            $storeManager,
            $customerUrl,
            $customerAccountManagement,
            $subscriptionManager,
            $emailValidator,
            $customerRepository
        );
        $this->customerAccountManagement = $customerAccountManagement;
        $this->subscriptionManager = $subscriptionManager;
        $this->emailValidator = $emailValidator ?: ObjectManager::getInstance()->get(EmailValidator::class);
        $this->customerRepository = $customerRepository ?: ObjectManager::getInstance()
            ->get(CustomerRepositoryInterface::class);
        $this->nameValidator = $nameValidator;
    }

    /**
     * Check name not empty
     *
     * @param $name
     * @throws LocalizedException
     */
    public function validateNameNotEmpty($name)
    {
        if (!$this->nameValidator->isValid($name)) {
            throw new LocalizedException(__('Please enter name'));
        }

    }

    /**
     * Add email and username to the database
     *
     * @return Redirect
     */
    public function execute()
    {
        if ($this->getRequest()->isPost() && $this->getRequest()->getPost('email')) {
            $email = (string)$this->getRequest()->getPost('email');
            $name = (string)$this->getRequest()->getPost('name');

            try {
                $this->validateEmailFormat($email);
                $this->validateGuestSubscription();
                $this->validateEmailAvailable($email);
                $this->validateNameNotEmpty($name);

                $websiteId = (int)$this->_storeManager->getStore()->getWebsiteId();
                $subscriber = $this->_subscriberFactory->create()->loadBySubscriberEmail($email, $websiteId);
                if ($subscriber->getId()
                    && (int)$subscriber->getSubscriberStatus() === Subscriber::STATUS_SUBSCRIBED) {
                    throw new LocalizedException(
                        __('This email address is already subscribed.')
                    );
                }
                $storeId = (int)$this->_storeManager->getStore()->getId();
                $currentCustomerId = $this->getCustomerId($email, $websiteId);

                $subscriber = $currentCustomerId
                    ? $this->subscriptionManager->subscribeCustomer($currentCustomerId, $storeId)
                    : $this->subscriptionManager->subscribe($email, $storeId);
                $subscriber->setSubscriberName($name);
                $subscriber->save();
                $message = $this->getSuccessMessage((int)$subscriber->getSubscriberStatus());
                $this->messageManager->addSuccessMessage($message);
            } catch (LocalizedException $e) {
                $this->messageManager->addComplexErrorMessage(
                    'localizedSubscriptionErrorMessage',
                    ['message' => $e->getMessage()]
                );
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong with the subscription.'));
            }
        }

        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $redirectUrl = $this->_redirect->getRedirectUrl();
        return $redirect->setUrl($redirectUrl);
    }

    /**
     * Get customer Id
     *
     * @param string $email
     * @param int $websiteId
     * @return int|null
     * @throws LocalizedException
     */
    private function getCustomerId(string $email, int $websiteId): ?int
    {
        try {
            $customer = $this->customerRepository->get($email, $websiteId);
            return (int)$customer->getId();
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            return null;
        }
    }

    /**
     * Get success message
     *
     * @param int $status
     * @return Phrase
     */
    private function getSuccessMessage(int $status): Phrase
    {
        if ($status === Subscriber::STATUS_NOT_ACTIVE) {
            return __('The confirmation request has been sent.');
        }

        return __('Thank you for your subscription.');
    }
}
