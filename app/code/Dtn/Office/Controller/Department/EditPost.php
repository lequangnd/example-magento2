<?php

namespace Dtn\Office\Controller\Department;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Dtn\Office\Model\DepartmentFactory;

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
            $departmentId = $postData['departmentId'];
            $name = $postData['name'];

            $department = $this->departmentFactory->create();
            $department->load($departmentId);
            $department->setName($name);
            $department->save();
        }

        $this->messageManager->addSuccessMessage(__('Edit Department successful'));
        return $this->resultRedirectFactory->create()->setUrl('/dtn/department/index');
    }

}
