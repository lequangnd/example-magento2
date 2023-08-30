<?php

namespace Dtn\Office\Controller\Department;

use Dtn\Office\Model\DepartmentFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;

class Edit extends Action implements HttpGetActionInterface
{
    /**
     * Edit constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param Registry $registry
     * @param DepartmentFactory $departmentFactory
     */
    public function __construct(
        protected Context $context,
        protected PageFactory $resultPageFactory,
        protected Registry $registry,
        protected DepartmentFactory $departmentFactory,
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        $this->_initDepartment();
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }

    /**
     * Get department data into registry
     *
     * @return \Magento\Framework\Message\ManagerInterface|void
     */
    public function _initDepartment()
    {
        $departmentId = $this->getRequest()->getParam('id');
        $department = $this->getDepartmentById($departmentId);

        if ($department !== null) {
            return $this->registry->register('current_department', $department);
        }
        return $this->messageManager->addErrorMessage(__('Department does not exits'));
    }

    /**
     * Get department data by Id
     *
     * @param $departmentId
     * @return \Dtn\Office\Model\Department|null
     */
    public function getDepartmentById($departmentId)
    {
        $department = $this->departmentFactory->create();
        $department->load($departmentId);
        if ($department->getId()) {
            return $department;
        }
        return null;
    }
}
