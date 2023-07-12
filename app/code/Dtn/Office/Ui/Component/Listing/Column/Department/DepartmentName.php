<?php

namespace Dtn\Office\Ui\Component\Listing\Column\Department;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Dtn\Office\Model\DepartmentFactory;

class DepartmentName extends Column
{

    protected $departmentFactory;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        DepartmentFactory $departmentFactory,
        array $components = [],
        array $data = []
    )
    {
        $this->departmentFactory = $departmentFactory;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $department = $this->departmentFactory->create();
            foreach ($dataSource['data']['items'] as &$item) {
                $departmentId = $item['department_id'];
                $department->load($departmentId);
                $departmentName = $department->getName();
                $item[$this->getData('name')] = $departmentName;
            }
        }

        return $dataSource;
    }

}
