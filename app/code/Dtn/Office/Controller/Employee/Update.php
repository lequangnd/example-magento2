<?php

namespace Dtn\Office\Controller\Employee;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;
use Dtn\Office\Model\EmployeeFactory;

class Update extends Action implements HttpGetActionInterface
{
    public function __construct(
        protected Context $context,
        protected PageFactory $resultPageFactory,
        protected Registry $registry,
        protected EmployeeFactory $employeeFactory,
    )
    {
        parent::__construct($context);
    }

    public function execute()
    {
        $this->_initEmployee();
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }

    public function _initEmployee()
    {
        $employeeId = $this->getRequest()->getParam('id');
        $employee = $this->employeeFactory->create();
        $employee->load($employeeId);
        if ($employee->getEmployeeId()) {
            return $this->registry->register('current_employee', $employee);
        } else {
            return $this->messageManager->addErrorMessage(__('Employee does not exits'));
        }
    }
}
