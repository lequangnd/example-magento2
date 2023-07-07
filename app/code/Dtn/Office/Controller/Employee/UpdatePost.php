<?php

namespace Dtn\Office\Controller\Employee;

use Dtn\Office\Model\EmployeeFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\View\Result\PageFactory;

class UpdatePost extends Action implements HttpPostActionInterface
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
        if ($this->getRequest()->isPost()) {
            $postData = $this->getRequest()->getPostValue();

            // Lấy dữ liệu từ form
            $employeeId = $postData['id'];
            $full_name = $postData['full_name'];
            $address = $postData['address'];
            $telephone = $postData['telephone'];
            $department_id = $postData['department_id'];
            $dob = $postData['dob'];

            // Thực hiện insert dữ liệu vào cơ sở dữ liệu
            $employee = $this->employeeFactory->create();
            $employee->load($employeeId);
            $employee->setFullName($full_name);
            $employee->setAddress($address);
            $employee->setTelephone($telephone);
            $employee->setDepartmentId($department_id);
            $employee->setDob($dob);
            $employee->save();

            $this->messageManager->addSuccessMessage(__('Update Employee Successful'));
            $redirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
            $redirect->setUrl('/dtn/employee/');
            return $redirect;

        }
    }

}
