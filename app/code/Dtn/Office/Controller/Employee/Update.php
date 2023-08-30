<?php

namespace Dtn\Office\Controller\Employee;

use Dtn\Office\Model\EmployeeFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;

class Update extends Action implements HttpGetActionInterface
{
    /**
     * Update constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param Registry $registry
     * @param EmployeeFactory $employeeFactory
     */
    public function __construct(
        protected Context $context,
        protected PageFactory $resultPageFactory,
        protected Registry $registry,
        protected EmployeeFactory $employeeFactory,
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        $this->_initEmployee();
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }

    /**
     * Get employee data into registry
     *
     * @return \Magento\Framework\Message\ManagerInterface|void
     */
    public function _initEmployee()
    {
        $employeeId = $this->getRequest()->getParam('id');
        $employee = $this->getEmployeeId($employeeId);

        if ($employee !== null) {
            return $this->registry->register('current_employee', $employee);
        }
        return $this->messageManager->addErrorMessage(__('Employee does not exits'));
    }

    /**
     * Get employee by Id
     *
     * @param $employeeId
     * @return \Dtn\Office\Model\Employee|null
     */
    public function getEmployeeId($employeeId)
    {
        $employee = $this->employeeFactory->create();
        $employee->load($employeeId);
        if ($employee->getId()) {
            return $employee;
        }
        return null;
    }
}
