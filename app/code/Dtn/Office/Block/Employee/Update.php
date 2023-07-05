<?php

namespace Dtn\Office\Block\Employee;

use Dtn\Office\Model\EmployeeFactory;
use Dtn\Office\Model\ResourceModel\Department\CollectionFactory;
use Magento\Framework\View\Element\Template;

class Update extends Template
{
    public function __construct(
        Template\Context $context,
        protected CollectionFactory $departmentCollectionFactory,
        protected EmployeeFactory $employeeFactory,
        array $data = []
    )
    {
        parent::__construct($context, $data);
    }


    public function getEmployee()
    {
        $employeeId=$this->getRequest()->getParam('id');
        $employee=$this->employeeFactory->create();
        $employee->load($employeeId);
        return $employee;

    }

    public function getDepartmentName()
    {
        return $this->departmentCollectionFactory->create();
    }

}
