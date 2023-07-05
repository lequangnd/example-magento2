<?php

namespace Dtn\Office\Controller\Employee;

use Dtn\Office\Model\EmployeeFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\View\Result\PageFactory;

class CreatePost extends Action implements HttpPostActionInterface
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
            $full_name = $postData['full_name'];
            $address = $postData['address'];
            $telephone = $postData['telephone'];
            $department_id = $postData['department_id'];
            $dob = $postData['dob'];

            // Thực hiện insert dữ liệu vào cơ sở dữ liệu
            $employee = $this->employeeFactory->create();
            $employee->setData([
                'full_name' => $full_name,
                'address' => $address,
                'telephone' => $telephone,
                'department_id' => $department_id,
                'dob' => $dob
            ]);
            $employee->save();

            echo "<script type='text/javascript'>alert('Post Employee successful');</script>";
        }
    }

}
