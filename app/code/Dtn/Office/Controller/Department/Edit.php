<?php

namespace Dtn\Office\Controller\Department;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;
use Dtn\Office\Model\DepartmentFactory;

class Edit extends Action implements HttpGetActionInterface
{
    public function __construct(
        protected Context $context,
        protected PageFactory $resultPageFactory,
        protected Registry $registry,
        protected DepartmentFactory $departmentFactory,
    )
    {
        parent::__construct($context);
    }

    public function execute()
    {
        $this->_initDepartment();
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }

    public function _initDepartment()
    {
        $departmentId = $this->getRequest()->getParam('id');
        $department = $this->departmentFactory->create();
        $department->load($departmentId);
        if ($department->getId()) {
            return $this->registry->register('current_department',$department);
        }else{
            return $this->messageManager->addErrorMessage(__('Department does not exits'));
        }
    }

}
