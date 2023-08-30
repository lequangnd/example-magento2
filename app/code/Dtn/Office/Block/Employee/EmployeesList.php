<?php

namespace Dtn\Office\Block\Employee;

use Dtn\Office\Model\ResourceModel\Employee\CollectionFactory;
use Dtn\Office\Model\DepartmentFactory;
use Magento\Framework\View\Element\Template;
use Magento\Theme\Block\Html\Pager;

class EmployeesList extends Template
{
    /**
     * EmployeesList constructor.
     * @param Template\Context $context
     * @param CollectionFactory $employeeCollectionFactory
     * @param DepartmentFactory $departmentFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        protected CollectionFactory $employeeCollectionFactory,
        protected DepartmentFactory $departmentFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * Get department collection and configure the current record on a page
     *
     * @return \Dtn\Office\Model\ResourceModel\Employee\Collection
     */
    public function getEmployeesCollection()
    {
        $pageSize = 10; // Số lượng bản ghi trên mỗi trang
        $currentPage = (int)$this->getRequest()->getParam('p'); // Lấy trang hiện tại từ URL

        $employeeCollection = $this->employeeCollectionFactory->create();
        $employeeCollection->setPageSize($pageSize);
        $employeeCollection->setCurPage($currentPage);

        return $employeeCollection;
    }

    /**
     * Get pager HTML
     *
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
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
