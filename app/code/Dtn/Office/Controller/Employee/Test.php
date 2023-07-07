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

//        $collection = $this->employeeCollectionFactory->create();
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

//        echo "addFieldToFilter lteq: ";
//        $collection->addFieldToFilter('employee_id', ['lteq' => '3']);
//        foreach ($collection as $employee) {
//            echo $employee->getFullName() . " ";
//        }
//        echo "<br>";

        /*
         * insert employee
         */
//        $employee=$this->employeeFactory->create();
//        $employee->setFullName('Bùi Văn a');
//        $employee->setAddress('Ha Noi');
//        $employee->setTelephone('0988767679');
//        $employee->setDepartmentId('1');
//        $employee->setDob('2000/01/01');
//        $employee->save();
//
//        $employee=$this->employeeFactory->create();
//        $employee->setFullName('Bui Van B');
//        $employee->setAddress('Nam Định');
//        $employee->setTelephone('94384965879');
//        $employee->setDepartmentId('2');
//        $employee->setDob('2000/01/02');
//        $employee->save();

        $employee = $this->employeeFactory->create();
        $employee->setFullName('Nguyen Thi A');
        $employee->setAddress('Ninh Binh');
        $employee->setTelephone('0976182986');
        $employee->setDepartmentId('3');
        $employee->setDob('2000/01/03');
        $employee->save();

        $employee = $this->employeeFactory->create();
        $employee->setFullName('Nguyen Thi B');
        $employee->setAddress('Ha Noi');
        $employee->setTelephone('0999898989');
        $employee->setDepartmentId('1');
        $employee->setDob('2000/01/04');
        $employee->save();

        $employee = $this->employeeFactory->create();
        $employee->setFullName('Nguyen Thi C');
        $employee->setAddress('Ha Noi');
        $employee->setTelephone('0999898989');
        $employee->setDepartmentId('2');
        $employee->setDob('2000/01/05');
        $employee->save();

        $employee = $this->employeeFactory->create();
        $employee->setFullName('Le Van A');
        $employee->setAddress('Nam Dinh');
        $employee->setTelephone('0988889899');
        $employee->setDepartmentId('3');
        $employee->setDob('2001/01/16');
        $employee->save();

        $employee = $this->employeeFactory->create();
        $employee->setFullName('Nguyen Van a');
        $employee->setAddress('Ha Noi');
        $employee->setTelephone('0999898989');
        $employee->setDepartmentId('1');
        $employee->setDob('2000/12/09');
        $employee->save();

        $employee = $this->employeeFactory->create();
        $employee->setFullName('Nguyen Van B');
        $employee->setAddress('Ha Nam');
        $employee->setTelephone('0999898989');
        $employee->setDepartmentId('1');
        $employee->setDob('1999/01/01');
        $employee->save();

        $employee = $this->employeeFactory->create();
        $employee->setFullName('Nguyen Van C');
        $employee->setAddress('Ha Noi');
        $employee->setTelephone('0999898989');
        $employee->setDepartmentId('1');
        $employee->setDob('2001/01/01');
        $employee->save();

        $employee = $this->employeeFactory->create();
        $employee->setFullName('Nguyen a');
        $employee->setAddress('Ha Noi');
        $employee->setTelephone('0999898989');
        $employee->setDepartmentId('1');
        $employee->setDob('2000/01/01');
        $employee->save();

        exit;
    }
}
