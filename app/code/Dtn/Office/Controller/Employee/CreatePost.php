<?php

namespace Dtn\Office\Controller\Employee;

use Dtn\Office\Model\EmployeeFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\View\Result\PageFactory;

class CreatePost extends Action implements HttpPostActionInterface
{
    /**
     * CreatePost constructor.
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

            if ($this->addEmployee($postData)) {
                $this->messageManager->addSuccessMessage(__('Add Employee Successful'));
                return $this->resultRedirectFactory->create()->setUrl('/dtn/employee/index');
            }
            $this->messageManager->addErrorMessage(__('Add Employee Error'));
            return $this->resultRedirectFactory->create()->setUrl('/dtn/employee/create');
        }
    }

    /**
     * Add employee data to the database
     *
     * @param $data
     * @return bool
     * @throws \Exception
     */
    public function addEmployee($data)
    {
        $employee = $this->employeeFactory->create();
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
