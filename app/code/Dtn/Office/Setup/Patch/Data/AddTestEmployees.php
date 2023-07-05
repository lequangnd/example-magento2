<?php

namespace Dtn\Office\Setup\Patch\Data;

use Dtn\Office\Model\EmployeeFactory;
use Dtn\Office\Model\ResourceModel\Department\CollectionFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class AddTestEmployees implements DataPatchInterface
{
    public function __construct(
        protected EmployeeFactory $employeeFactory,
        protected CollectionFactory $departmentCollectionFactory,
    )
    {
    }

    /**
     * @inheritdoc
     */
    public function apply()
    {
        $faker = \Faker\Factory::create();

        $departmentIds = $this->departmentCollectionFactory->create()->getAllIds();

        // add 50 employees
        for ($i = 1; $i <= 50; $i++) {
            $departmentId = $departmentIds[array_rand($departmentIds)];
            $employee = $this->employeeFactory->create();
            $employee->setFullName($faker->name())
                ->setEmail($faker->email())
                ->setAddress($faker->address())
                ->setTelephone($faker->phoneNumber())
                ->setDepartmentId($departmentId);

            $employee->save();
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function getAliases()
    {
        return [];
    }
}
