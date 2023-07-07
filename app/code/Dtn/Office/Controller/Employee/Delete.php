<?php

namespace Dtn\Office\Controller\Employee;

use Dtn\Office\Model\EmployeeFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Delete extends Action implements HttpGetActionInterface
{
    public function __construct(
        protected Context $context,
        protected PageFactory $resultPageFactory,
        protected EmployeeFactory $employeeFactory,
    )
    {
        parent::__construct($context);
    }

    public function execute()
    {
        $employeeId = $this->getRequest()->getParam('id');
        if (isset($employeeId)) {
            $employee = $this->employeeFactory->create();
            $employee->load($employeeId);
            $employee->delete();

            $this->messageManager->addSuccessMessage(__('Delete Employee Successful'));
            $redirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
            $redirect->setUrl('/dtn/employee/');

            return $redirect;
        }
    }

}
