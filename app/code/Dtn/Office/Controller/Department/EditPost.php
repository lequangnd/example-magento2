<?php

namespace Dtn\Office\Controller\Department;

use Dtn\Office\Model\DepartmentFactory;
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
        if ($this->getRequest()->isPost()) {
            $postData = $this->getRequest()->getPostValue();
            $departmentId = $postData['departmentId'];

            if ($this->editDepartment($departmentId, $postData)) {
                $this->messageManager->addSuccessMessage(__('Edit Department successful'));
                return $this->resultRedirectFactory->create()->setUrl('/dtn/department/index');
            }
            $this->messageManager->addErrorMessage(__('Edit Department Error'));
            return $this->resultRedirectFactory->create()->setUrl('/dtn/department/edit?id=' . $departmentId);
        }
    }

    /**
     * Save the edited department data to the database
     *
     * @param $departmentId
     * @param $data
     * @return bool
     * @throws \Exception\
     */
    public function editDepartment($departmentId, $data)
    {
        $department = $this->departmentFactory->create();
        $department->load($departmentId);
        $this->setDepartmentData($department, $data);
        $department->save();
        return true;
    }

    public function setDepartmentData($department, $data)
    {
        $department->setName($data['name']);
    }
}
