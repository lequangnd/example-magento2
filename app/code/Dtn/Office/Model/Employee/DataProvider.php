<?php

namespace Dtn\Office\Model\Employee;

use Dtn\Office\Model\ResourceModel\Employee\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Message\ManagerInterface;

class DataProvider extends AbstractDataProvider
{
    /**
     * Loaded data
     *
     * @var
     */
    protected $loadedData;

    /**
     * Request interface
     *
     * @var RequestInterface
     */
    protected $request;

    /**
     * Message manager
     *
     * @var ManagerInterface
     */
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
    ) {
        $this->collection = $employeeCollectionFactory->create();
        $this->request = $request;
        $this->messageManager = $messageManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data for data provider
     *
     * @return array
     */
    public function getData()
    {
        if ($this->loadedData) {
            return $this->loadedData;
        }

        $employeeId = $this->request->getParam('id');
        if ($employeeId && !$this->checkEmployee($employeeId)) {
            return [];
        }

        $this->loadEmployeesData();

        return $this->loadedData;
    }

    /**
     * Check employee exits or not
     *
     * @param $employeeId
     * @return bool
     */
    public function checkEmployee($employeeId)
    {
        $employee = $this->collection->getFirstItem($employeeId);
        if (!$employee->getEmployeeId()) {
            $this->messageManager->addErrorMessage(__('Employee does not exit'));
            return false;
        }
        return true;
    }

    /**
     * Get employee data and assign to loaded data
     */
    public function loadEmployeesData()
    {
        $employeeCollection = $this->collection->getItems();
        foreach ($employeeCollection as $employee) {
            $this->loadedData[$employee->getEmployeeId()] = $employee->getData();
        }
    }
}
