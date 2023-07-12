<?php

namespace Dtn\Office\Model\Employee;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Dtn\Office\Model\ResourceModel\Employee\CollectionFactory;

class DataProvider extends AbstractDataProvider
{

    protected $loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $employeeCollectionFactory,
        array $meta = [],
        array $data = []
    )
    {
        $this->collection = $employeeCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {

        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $employee) {
            $this->loadedData[$employee->getEmployeeId()] = $employee->getData();
        }
        return $this->loadedData;
    }
}
