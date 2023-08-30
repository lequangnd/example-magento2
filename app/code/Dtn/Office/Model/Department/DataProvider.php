<?php

namespace Dtn\Office\Model\Department;

use Dtn\Office\Model\ResourceModel\Department\CollectionFactory;
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
        CollectionFactory $departmentCollectionFactory,
        RequestInterface $request,
        ManagerInterface $messageManager,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $departmentCollectionFactory->create();
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

        $departmentId = $this->request->getParam('id');
        if ($departmentId && !$this->checkDepartment($departmentId)) {
            return [];
        }

        $this->loadDepartmentsData();

        return $this->loadedData;
    }

    /**
     * Check department exits or not
     *
     * @param $departmentId
     * @return bool
     */
    public function checkDepartment($departmentId)
    {
        $department = $this->collection->getFirstItem($departmentId);
        if (!$department->getId()) {
            $this->messageManager->addErrorMessage(__('Department does not exits'));
            return false;
        }
        return true;
    }

    /**
     * Get department data and assign to loaded data
     */
    public function loadDepartmentsData()
    {
        $departmentCollection = $this->collection->getItems();
        foreach ($departmentCollection as $department) {
            $this->loadedData[$department->getId()] = $department->getData();
        }
    }
}
