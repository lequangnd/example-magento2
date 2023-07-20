<?php

namespace Dtn\Office\Block\Employee;

use Dtn\Office\Model\EmployeeFactory;
use Dtn\Office\Model\ResourceModel\Department\Grid\CollectionFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Registry;

class Update extends Template
{
    public function __construct(
        Template\Context $context,
        protected CollectionFactory $departmentCollectionFactory,
        protected EmployeeFactory $employeeFactory,
        protected ManagerInterface $messageManager,
        protected Registry $registry,
        array $data = []
    )
    {
        parent::__construct($context, $data);
    }

    public function getEmployee()
    {
        return $this->registry->registry('current_employee');
    }

    public function getDepartmentCollection()
    {
        return $this->departmentCollectionFactory->create();
    }

}
