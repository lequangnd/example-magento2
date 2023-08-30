<?php

namespace Dtn\Office\Ui\Component\Listing\Column\Employee;

use Magento\Ui\Component\Listing\Columns\Column;

class Actions extends Column
{
    /**
     * Create edit and delete actions
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $itemId = $item['employee_id'];
                $item[$this->getData('name')]['edit'] = [
                    'href' => $this->getContext()->getUrl(
                        'dtn/employee/edit',
                        ['id' => $itemId]
                    ),
                    'label' => __('Edit'),
                    'hidden' => false,
                ];

                $item[$this->getData('name')]['delete'] = [
                    'href' => $this->getContext()->getUrl(
                        'dtn/employee/delete',
                        ['id' => $itemId]
                    ),
                    'label' => __('Delete'),
                    'confirm' => [
                        'title' => __('Delete Employee'),
                        'message' => __('Are you sure you want to delete this employee?')
                    ]
                ];
            }
        }

        return $dataSource;
    }
}
