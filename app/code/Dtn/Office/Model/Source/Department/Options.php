<?php

namespace Dtn\Office\Model\Source\Department;

use Dtn\Office\Model\ResourceModel\Department\CollectionFactory;
use Magento\Framework\Data\OptionSourceInterface;

class Options implements OptionSourceInterface
{
    /**
     * Department collection factory
     *
     * @var CollectionFactory
     */
    protected $departmentCollectionFactory;

    /**
     * Options constructor.
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->departmentCollectionFactory = $collectionFactory;
    }

    /**
     * Create option array department data
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];

        $department = $this->departmentCollectionFactory->create();
        $departmentCollection = $department->addFieldToSelect(['department_id', 'name'])->getItems();

        foreach ($departmentCollection as $department) {
            $options[] = [
                'value' => $department->getDepartmentId(),
                'label' => $department->getName()
            ];
        }

        return $options;
    }
}
