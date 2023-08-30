<?php

namespace Dtn\Office\Controller\Adminhtml\Department;

use Dtn\Office\Model\DepartmentFactory;
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
     * @param DepartmentFactory $departmentFactory
     */
    public function __construct(
        protected Context $context,
        protected PageFactory $resultPageFactory,
        protected DepartmentFactory $departmentFactory,
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        $departmentId = $this->getRequest()->getParam('id');
        $this->deleteDepartment($departmentId);
        $this->messageManager->addSuccessMessage(__('Delete Department Successful'));
        return $this->resultRedirectFactory->create()->setPath('*/*/');
    }

    /**
     * Delete department data
     *
     * @param $departmentId
     * @return bool
     * @throws \Exception
     */
    public function deleteDepartment($departmentId)
    {
        $department = $this->departmentFactory->create();
        $department->load($departmentId);
        $department->delete();
        return true;
    }
}
