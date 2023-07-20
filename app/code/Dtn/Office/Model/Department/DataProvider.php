<?php

namespace Dtn\Office\Model\Department;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Dtn\Office\Model\ResourceModel\Department\CollectionFactory;
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
        CollectionFactory $departmentCollectionFactory,
        RequestInterface $request,
        ManagerInterface $messageManager,
        array $meta = [],
        array $data = []
    )
    {
        $this->collection = $departmentCollectionFactory->create();
        $this->request = $request;
        $this->messageManager = $messageManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if ($this->loadedData) {
            return $this->loadedData;
        }

        $departmentId = $this->request->getParam('id');
        if ($departmentId) {
            $department = $this->collection->getFirstItem($departmentId);
            if (!$department->getId()) {
                $this->messageManager->addErrorMessage(__('Department does not exits'));
                return [];
            }
        }
        $departments = $this->collection->getItems();
        foreach ($departments as $department) {
            $this->loadedData[$department->getId()] = $department->getData();
        }
        return $this->loadedData;
    }
}
