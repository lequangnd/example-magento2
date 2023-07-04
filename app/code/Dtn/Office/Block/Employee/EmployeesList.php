<?php

namespace Dtn\Office\Block\Employee;

use Dtn\Office\Model\ResourceModel\Employee\CollectionFactory;
use Dtn\Office\Model\DepartmentFactory;
use Magento\Framework\View\Element\Template;

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

    /**
     *
     * @return \Dtn\Office\Model\ResourceModel\Employee\Collection
     */
    public function getEmployeesCollection()
    {
        return $this->employeeCollectionFactory->create();
    }

    public function getDepartmentName($departmentId)
    {
        $departmentName = $this->departmentFactory->create();
        $departmentName->load($departmentId);
        return $departmentName->getName();
    }

}
