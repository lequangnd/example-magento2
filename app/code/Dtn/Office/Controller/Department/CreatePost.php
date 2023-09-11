<?php

namespace Dtn\Office\Controller\Department;

use Dtn\Office\Api\DepartmentRepositoryInterface;
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
        if ($this->getRequest()->isPost()) {
            $postData = $this->getRequest()->getPostValue();

            if ($this->addDepartment($postData)) {
                $this->messageManager->addSuccessMessage(__('Add Department successful'));
                return $this->resultRedirectFactory->create()->setUrl('/dtn/department/index');
            }
            $this->messageManager->addErrorMessage(__('Add Department Error'));
            return $this->resultRedirectFactory->create()->setUrl('/dtn/department/create');
        }
    }

    /**
     * @param $data
     * @return bool
     */
    public function addDepartment($data)
    {
        $this->departmentRepository->create($data);
        return true;
    }
}
