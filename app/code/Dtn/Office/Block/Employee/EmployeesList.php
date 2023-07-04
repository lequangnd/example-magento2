<?php

namespace Dtn\Office\Block\Employee;

use Dtn\Office\Model\ResourceModel\Employee\CollectionFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\App\ResourceConnection;
class EmployeesList extends Template
{
    public function __construct(
        Template\Context $context,
        protected CollectionFactory $employeeCollectionFactory,
        protected ResourceConnection $resourceConnection,
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

    public function getDepartmentName($departmentId)
    {
        $connection = $this->resourceConnection->getConnection();
        $tableName = $this->resourceConnection->getTableName('dtn_department');

        $select = $connection->select()->from($tableName, ['name'])->where('department_id = ?', $departmentId);

        $departmentName = $connection->fetchOne($select);

        return $departmentName;
    }

}
