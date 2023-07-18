<?php

namespace Dtn\Office\Controller\Adminhtml\Department;

use Dtn\Office\Model\DepartmentFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\View\Result\PageFactory;


class EditPost extends Action implements HttpPostActionInterface
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
        if ($this->getRequest()->isPost()) {
            $postData = $this->getRequest()->getPostValue();

            // Lấy dữ liệu từ
            $departmentId = $postData['department_id'];
            $name = $postData['name'];

            // Thực hiện insert dữ liệu vào cơ sở dữ liệu
            $department = $this->departmentFactory->create();
            $department->load($departmentId);
            $department->setName($name);
            $department->save();

            $this->messageManager->addSuccessMessage(__('Edit Department Successful'));
            $redirect = $this->resultRedirectFactory->create();
            $redirect->setPath('*/*/');

            return $redirect;
        }
    }

}
