<?php

namespace Dtn\Office\Controller\Adminhtml\Department;

use Dtn\Office\Model\DepartmentFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;


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

        // Thực hiện insert dữ liệu vào cơ sở dữ liệu
        $department = $this->departmentFactory->create();
        $department->load($departmentId);
        $department->delete();

        $this->messageManager->addSuccessMessage(__('Delete Department Successful'));
        $redirect = $this->resultRedirectFactory->create();
        $redirect->setPath('*/*/');

        return $redirect;
    }

}
