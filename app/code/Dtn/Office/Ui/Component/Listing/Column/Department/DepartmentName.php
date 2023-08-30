<?php

namespace Dtn\Office\Ui\Component\Listing\Column\Department;

use Dtn\Office\Model\DepartmentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class DepartmentName extends Column
{
    /**
     * Department factory
     *
     * @var DepartmentFactory
     */
    protected $departmentFactory;

    /**
     * DepartmentName constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param DepartmentFactory $departmentFactory
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        DepartmentFactory $departmentFactory,
        array $components = [],
        array $data = []
    ) {
        $this->departmentFactory = $departmentFactory;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Get department name for ui component
     *
     * @param array $dataSource
     * @return array
     */
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
