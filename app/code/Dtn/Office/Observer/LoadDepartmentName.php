<?php

namespace Dtn\Office\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Dtn\Office\Model\ResourceModel\Department\CollectionFactory as DepartmentCollectionFactory;

class LoadDepartmentName implements ObserverInterface
{
    protected $departmentCollectionFactory;

    public function __construct(
        DepartmentCollectionFactory $departmentCollectionFactory
    )
    {
        $this->departmentCollectionFactory = $departmentCollectionFactory;
    }

    public function execute(Observer $observer)
    {
        $employeeCollection = $observer->getData('employee_collection');

        $departmentNames = [];
        $departmentCollection = $this->departmentCollectionFactory->create();

        foreach ($employeeCollection as $employee) {
            $department = $departmentCollection->getItemById($employee->getDepartmentId());
            $departmentNames[$department->getId()] = $department->getName();
            $employee->setDepartmentName($departmentNames[$department->getId()]);

        }
    }
}
