<?php

namespace Dtn\Office\Model\Source\Department;

use Magento\Framework\Data\OptionSourceInterface;
use Dtn\Office\Model\ResourceModel\Department\Grid\CollectionFactory;

class Options implements OptionSourceInterface
{
    protected $collectionFactory;

    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    public function toOptionArray()
    {
        $options = [];

        $collection = $this->collectionFactory->create();
        $departments = $collection->addFieldToSelect(['department_id', 'name'])->getItems();

        foreach ($departments as $department) {
            $options[] = [
                'value' => $department->getDepartmentId(),
                'label' => $department->getName()
            ];
        }

        return $options;
    }

}
