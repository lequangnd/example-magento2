<?php

namespace Dtn\Office\Controller\Adminhtml\Employee;

use Dtn\Office\Model\EmployeeFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\View\Result\PageFactory;

class EditPost extends Action implements HttpPostActionInterface
{
    /**
     * EditPost constructor.
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
        if ($this->getRequest()->isPost()) {
            $postData = $this->getRequest()->getPostValue();
            $employeeId = $postData['employee_id'];

            if ($this->editEmployee($employeeId, $postData)) {
                $this->messageManager->addSuccessMessage(__('Edit Employee Successful'));
                return $this->resultRedirectFactory->create()->setPath('*/*/');
            }
            $this->messageManager->addSuccessMessage(__('Edit Employee Error'));
            return $this->resultRedirectFactory->create()->setPath('dtn/employee/edit/id/' . $employeeId);
        }
    }

    /**
     * Save the edited department data to the database
     *
     * @param $employeeId
     * @param $data
     * @return bool
     * @throws \Exception
     */
    public function editEmployee($employeeId, $data)
    {
        $employee = $this->employeeFactory->create();
        $employee->load($employeeId);
        $this->setEmployeeData($employee, $data);
        $employee->save();
        return true;
    }

    /**
     * Set employee data
     *
     * @param $employee
     * @param $data
     */
    public function setEmployeeData($employee, $data)
    {
        $employee->setFullName($data['full_name']);
        $employee->setAddress($data['address']);
        $employee->setTelephone($data['telephone']);
        $employee->setDepartmentId($data['department_id']);
        $employee->setDob($data['dob']);
    }
}
