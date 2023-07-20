<?php

namespace Dtn\Office\Block\Employee;

use Dtn\Office\Model\ResourceModel\Employee\Grid\CollectionFactory;
use Dtn\Office\Model\DepartmentFactory;
use Magento\Framework\View\Element\Template;
use Magento\Theme\Block\Html\Pager;

class EmployeesList extends Template
{
    public function __construct(
        Template\Context $context,
        protected CollectionFactory $employeeCollectionFactory,
        protected DepartmentFactory $departmentFactory,
        array $data = []
    )
    {
        parent::__construct($context, $data);
    }

    public function getEmployeesCollection()
    {
        $pageSize = 10; // Số lượng bản ghi trên mỗi trang
        $currentPage = (int)$this->getRequest()->getParam('p'); // Lấy trang hiện tại từ URL

        $employeeCollection = $this->employeeCollectionFactory->create();
        $employeeCollection->setPageSize($pageSize);
        $employeeCollection->setCurPage($currentPage);

        return $employeeCollection;
    }

    public function getDepartmentName($departmentId)
    {
        $departmentName = $this->departmentFactory->create();
        $departmentName->load($departmentId);
        return $departmentName->getName();
    }

    public function getPagerHtml()
    {
        $pager = $this->getLayout()->createBlock(
            Pager::class,
            'employee.list.pager'
        )->setCollection(
            $this->getEmployeesCollection()
        );

        return $pager->toHtml();
    }

}
