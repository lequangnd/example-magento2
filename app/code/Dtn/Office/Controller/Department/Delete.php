<?php

namespace Dtn\Office\Controller\Department;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Dtn\Office\Model\DepartmentFactory;

class Delete extends Action implements HttpGetActionInterface
{
    public function __construct(
        protected Context $context,
        protected PageFactory $resultPageFactory,
        protected DepartmentFactory $departmentFactory,
    )
    {
        parent::__construct($context);
    }

    public function execute()
    {
        $departmentId = $this->getRequest()->getParam('id');
        $department = $this->departmentFactory->create();
        $department->load($departmentId);
        $department->delete();

        $this->messageManager->addSuccessMessage(__('Delete Department Successful'));

        return $this->resultRedirectFactory->create()->setUrl('/dtn/department/index');
    }

}
