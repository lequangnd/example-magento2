<?php

namespace Dtn\Office\Controller\Adminhtml\Employee;

use Dtn\Office\Model\ResourceModel\Employee\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;

class MassDelete extends Action
{
    /**
     * Employee collection factory instance
     *
     * @var CollectionFactory
     */
    protected $employeeCollectionFactory;

    /**
     * Filter instance
     *
     * @var Filter
     */
    protected $filter;

    /**
     * MassDelete constructor.
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
    ) {
        $this->filter = $filter;
        $this->employeeCollectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->employeeCollectionFactory->create());

            $count = 0;

            foreach ($collection as $item) {
                $deleteItem = $this->_objectManager->get('Dtn\Office\Model\Employee')->load($item->getId());
                $deleteItem->delete();
                $count++;
            }
            $this->messageManager->addSuccess(__('A total of %1 Employee(s) have been deleted.', $count));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');
    }
}
