<?php

namespace Dtn\Office\Block\Employee;

use Dtn\Office\Model\EmployeeFactory;
use Dtn\Office\Model\ResourceModel\Department\CollectionFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Registry;

class Update extends Template
{
    /**
     * Update constructor.
     * @param Template\Context $context
     * @param CollectionFactory $departmentCollectionFactory
     * @param EmployeeFactory $employeeFactory
     * @param ManagerInterface $messageManager
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        protected CollectionFactory $departmentCollectionFactory,
        protected EmployeeFactory $employeeFactory,
        protected ManagerInterface $messageManager,
        protected Registry $registry,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * Get employee data from registry
     *
     * @return mixed|null
     */
    public function getEmployee()
    {
        return $this->registry->registry('current_employee');
    }

    /**
     * Get department collection
     *
     * @return \Dtn\Office\Model\ResourceModel\Department\Collection
     */
    public function getDepartmentCollection()
    {
        return $this->departmentCollectionFactory->create();
    }
}
