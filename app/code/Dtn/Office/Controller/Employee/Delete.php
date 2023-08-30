<?php

namespace Dtn\Office\Controller\Employee;

use Dtn\Office\Model\EmployeeFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Delete extends Action implements HttpGetActionInterface
{
    /**
     * Delete constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param EmployeeFactory $employeeFactory
     */
    public function __construct(
        protected Context $context,
        protected PageFactory $resultPageFactory,
        protected EmployeeFactory $employeeFactory,
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        $employeeId = $this->getRequest()->getParam('id');
        $this->deleteEmployee($employeeId);
        $this->messageManager->addSuccessMessage(__('Delete Employee Successful'));
        return $this->resultRedirectFactory->create()->setUrl('/dtn/employee/index');
    }

    /**
     * Delete employee data
     *
     * @param $employeeId
     * @return bool
     * @throws \Exception
     */
    public function deleteEmployee($employeeId)
    {
        $employee = $this->employeeFactory->create();
        $employee->load($employeeId);
        $employee->delete();
        return true;
    }
}
