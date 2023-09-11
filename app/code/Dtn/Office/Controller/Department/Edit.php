<?php

namespace Dtn\Office\Controller\Department;

use Dtn\Office\Api\DepartmentRepositoryInterface;
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
     * @param DepartmentRepositoryInterface $departmentRepository
     */
    public function __construct(
        protected Context $context,
        protected PageFactory $resultPageFactory,
        protected Registry $registry,
        protected DepartmentRepositoryInterface $departmentRepository,
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

    /**
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
     * @param $departmentId
     * @return mixed|null
     */
    public function getDepartmentById($departmentId)
    {
        $department = $this->departmentRepository->getById($departmentId);
        if ($department->getId()) {
            return $department;
        }
        return null;
    }
}
