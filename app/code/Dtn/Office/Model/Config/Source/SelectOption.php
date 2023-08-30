<?php

namespace Dtn\Office\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;
use Dtn\Office\Model\ResourceModel\Department\CollectionFactory;

class SelectOption implements ArrayInterface
{
    /**
     * Department collection factory instance
     *
     * @var CollectionFactory
     */
    protected $departmentCollectionFactory;

    /**
     * SelectOption constructor.
     * @param CollectionFactory $departmentCollectionFactory
     */
    public function __construct(CollectionFactory $departmentCollectionFactory)
    {
        $this->departmentCollectionFactory = $departmentCollectionFactory;
    }

    /**
     * Create select array departments data
     *
     * @return array
     */
    public function toOptionArray()
    {
        $arr = [];
        $departmentCollection = $this->departmentCollectionFactory->create();

        foreach ($departmentCollection as $department) {
            $arr[] = ['value' => $department->getId(), 'label' => $department->getName()];
        }

        return $arr;
    }
}
