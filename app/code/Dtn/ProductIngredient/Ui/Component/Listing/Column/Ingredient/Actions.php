<?php

namespace Dtn\ProductIngredient\Ui\Component\Listing\Column\Ingredient;

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
                $itemId = $item['ingredient_id'];
                $item[$this->getData('name')]['edit'] = [
                    'href' => $this->getContext()->getUrl(
                        'dtn/ingredient/edit',
                        ['id' => $itemId]
                    ),
                    'label' => __('Edit'),
                    'hidden' => false,
                ];


            }
        }

        return $dataSource;
    }
}
