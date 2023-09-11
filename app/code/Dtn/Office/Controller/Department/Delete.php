<?php

namespace Dtn\Office\Controller\Department;

use Dtn\Office\Api\DepartmentRepositoryInterface;
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
     * @param DepartmentRepositoryInterface $departmentRepository
     */
    public function __construct(
        protected Context $context,
        protected PageFactory $resultPageFactory,
        protected DepartmentRepositoryInterface $departmentRepository,
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        $departmentId = $this->getRequest()->getParam('id');
        $this->deleteDepartment($departmentId);
        $this->messageManager->addSuccessMessage(__('Delete Department Successful'));
        return $this->resultRedirectFactory->create()->setUrl('/dtn/department/index');
    }

    /**
     * @param $departmentId
     * @return bool
     */
    public function deleteDepartment($departmentId)
    {
        $department = $this->departmentRepository->getById($departmentId);
        $department->delete();
        return true;
    }
}
