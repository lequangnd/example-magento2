<?php

namespace Dtn\Office\Controller\Department;

use Dtn\Office\Api\DepartmentRepositoryInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\View\Result\PageFactory;

class EditPost extends Action implements HttpPostActionInterface
{
    /**
     * EditPost constructor.
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
            $departmentId = $postData['departmentId'];

            if ($this->editDepartment($departmentId, $postData)) {
                $this->messageManager->addSuccessMessage(__('Edit Department successful'));
                return $this->resultRedirectFactory->create()->setUrl('/dtn/department/index');
            }

            $this->messageManager->addSuccessMessage(__('Edit Department Error'));
            return $this->resultRedirectFactory->create()->setUrl('/dtn/department/edit?id=' . $departmentId);
        }
    }

    /**
     * @param $departmentId
     * @param $data
     * @return bool
     */
    public function editDepartment($departmentId, $data)
    {
        $department = $this->departmentRepository->getById($departmentId);
        $this->setDepartment($department, $data);
        $department->save();
        return true;
    }

    /**
     * @param $department
     * @param $data
     */
    public function setDepartment($department, $data)
    {
        $department->setName($data['name']);
    }
}
