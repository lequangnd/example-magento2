<?php

namespace Dtn\Office\Model\Employee;

use Dtn\Office\Model\ResourceModel\Employee\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Framework\App\RequestInterface;

class DataProvider extends AbstractDataProvider
{

    protected $employeeCollectionFactory;
    protected $request;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $employeeCollectionFactory,
        RequestInterface $request,
        array $meta = [],
        array $data = []
    )
    {
        $this->collection = $employeeCollectionFactory->create();
        $this->employeeCollectionFactory = $employeeCollectionFactory;
        $this->request = $request;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        return [];
    }
}
