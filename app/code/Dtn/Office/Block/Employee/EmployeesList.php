<?php

namespace Dtn\Office\Block\Employee;

use Dtn\Office\Model\ResourceModel\Employee\CollectionFactory;
use Magento\Framework\View\Element\Template;

class EmployeesList extends Template
{
    public function __construct(
        Template\Context $context,
        protected CollectionFactory $employeeCollectionFactory,
        array $data = []
    ) {
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
}
