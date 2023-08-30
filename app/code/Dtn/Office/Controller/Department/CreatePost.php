<?php

namespace Dtn\Office\Controller\Department;

use Dtn\Office\Model\DepartmentFactory;
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

            if ($this->addDepartment($postData)) {
                $this->messageManager->addSuccessMessage(__('Add Department successful'));
                return $this->resultRedirectFactory->create()->setUrl('/dtn/department/index');
            }
            $this->messageManager->addErrorMessage(__('Add Department Error'));
            return $this->resultRedirectFactory->create()->setUrl('/dtn/department/create');
        }
    }

    /**
     * Add department data to the database
     *
     * @param $data
     * @return bool
     * @throws \Exception
     */
    public function addDepartment($data)
    {
        $department = $this->departmentFactory->create();
        $this->setDepartmentData($department, $data);
        $department->save();
        return true;
    }

    /**
     * Set department data
     *
     * @param $department
     * @param $data
     */
    public function setDepartmentData($department, $data)
    {
        $department->setName($data['name']);
    }
}
