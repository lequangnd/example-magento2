<?php

namespace Dtn\Office\Controller\Employee;

use Dtn\Office\Model\ResourceModel\Employee\CollectionFactory;
use Dtn\Office\Model\EmployeeFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;

class Test extends Action implements HttpGetActionInterface, HttpPostActionInterface
{
    public function __construct(
        protected Context $context,
        protected EmployeeFactory $employeeFactory,
        protected CollectionFactory $employeeCollectionFactory
    )
    {
        parent::__construct($context);
    }

    public function execute()
    {
//        $employee = $this->employeeFactory->create();
//        $employee->setFullName('Nguyen a');
//        $employee->setAddress('Ha Noi');
//        $employee->setTelephone('0999898989');
//        $employee->setDepartmentId('1');
//        $employee->setDob('2000/01/01');
//        $employee->save();

//        $employee->load(1);
//        echo $employee->getFullName();
//        $employee->delete();

        $collection = $this->employeeCollectionFactory->create();
//        $collection->load();
//        foreach($collection as $employee)
//         {
//            echo $employee->getFullName()."<br>";
//         }
//        $employee=$this->employeeFactory->create();
//        $employee->load(2);
//        $employee->setFullName('Quang');
//        $employee->save();

// Filter collection
//        echo "addFieldToFilter eq: ";
//        $collection->addFieldToFilter('full_name', ['eq' => 'Quang']);
//        foreach ($collection as $employee) {
//            echo $employee->getFullName()." ";
//        }
//        echo "<br>";
//
//        echo "addFieldToFilter neq: ";
//        $collection->addFieldToFilter('employee_id', ['neq' => 2]);
//        foreach ($collection as $employee) {
//            echo $employee->getFullName()." ";
//        }
//        echo "<br>";
//
//        echo "addFieldToFilter like: ";
//        $collection->addFieldToFilter('full_name', ['like' => '%Q%']);
//        foreach ($collection as $employee) {
//            echo $employee->getFullName()." ";
//        }
//        echo "<br>";
//
//        echo "addFieldToFilter gt: ";
//        $collection->addFieldToFilter('employee_id', ['gt' => '2']);
//        foreach ($collection as $employee) {
//            echo $employee->getFullName()." ";
//        }
//        echo "<br>";
//
//        echo "addFieldToFilter gt: ";
//        $collection->addFieldToFilter('employee_id', ['gteq' => '2']);
//        foreach ($collection as $employee) {
//            echo $employee->getFullName()." ";
//        }
//        echo "<br>";
//
//        echo "addFieldToFilter lt: ";
//        $collection->addFieldToFilter('employee_id', ['lt' => '3']);
//        foreach ($collection as $employee) {
//            echo $employee->getFullName()." ";
//        }
//        echo "<br>";

        echo "addFieldToFilter lteq: ";
        $collection->addFieldToFilter('employee_id', ['lteq' => '3']);
        foreach ($collection as $employee) {
            echo $employee->getFullName() . " ";
        }
        echo "<br>";


        exit;
    }
}
