<?php

namespace Dtn\Office\Controller\Department;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Create extends Action implements HttpGetActionInterface
{
    /**
     * Create constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        protected Context $context,
        protected PageFactory $resultPageFactory,
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }
}
