<?php

namespace Dtn\Office\Controller\Department;

use Dtn\Office\Model\ResourceModel\Department\CollectionFactory;
use Dtn\Office\Model\DepartmentFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;

class Test extends Action implements HttpGetActionInterface, HttpPostActionInterface
{
    public function __construct(
        protected Context $context,
        //protected DepartmentFactory $departmentFactory,
        protected CollectionFactory $departmentCollectionFactory
    )
    {
        parent::__construct($context);
    }

    public function execute()
    {
//        $department = $this->departmentFactory->create();
//        $department->setName('IT');
//        $department->save();

        $collection = $this->departmentCollectionFactory->create();
        $collection->load();
        foreach ($collection as $department) {
            echo $department->getName() . "<br>";
        }

        exit;
    }
}
