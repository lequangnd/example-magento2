<?php

namespace Dtn\Office\Model\Employee;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Dtn\Office\Model\ResourceModel\Employee\CollectionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Message\ManagerInterface;

class DataProvider extends AbstractDataProvider
{

    protected $loadedData;
    protected $request;
    protected $messageManager;


    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $employeeCollectionFactory,
        RequestInterface $request,
        ManagerInterface $messageManager,
        array $meta = [],
        array $data = []
    )
    {
        $this->collection = $employeeCollectionFactory->create();
        $this->request = $request;
        $this->messageManager = $messageManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $employeeId = $this->request->getParam('id');
        $employee = $this->collection->getItemById($employeeId);
        if ($employee && $employee->getEmployeeId()) {
            $items = $this->collection->getItems();
            foreach ($items as $employee) {
                $this->loadedData[$employee->getEmployeeId()] = $employee->getData();
            }
        } else {
            $this->messageManager->addErrorMessage(__('Employee does not exit'));
        }

        return $this->loadedData;
    }
}
