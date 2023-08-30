<?php

namespace Dtn\Office\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Dtn\Office\Model\ResourceModel\Department\CollectionFactory as DepartmentCollectionFactory;

class EmployeeDepartmentNameUpdaterObserver implements ObserverInterface
{
    /**
     * Department collection factory
     *
     * @var DepartmentCollectionFactory
     */
    protected $departmentCollectionFactory;

    /**
     * EmployeeDepartmentNameUpdaterObserver constructor.
     * @param DepartmentCollectionFactory $departmentCollectionFactory
     */
    public function __construct(
        DepartmentCollectionFactory $departmentCollectionFactory
    ) {
        $this->departmentCollectionFactory = $departmentCollectionFactory;
    }

    /**
     * Set department name for employee departmentId field
     *
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        $employeeCollection = $observer->getData('employee_collection');

        $departmentCollection = $this->departmentCollectionFactory->create();

        foreach ($employeeCollection as $employee) {
            $department = $departmentCollection->getItemById($employee->getDepartmentId());
            $employee->setDepartmentName($department->getName());

        }
    }
}
