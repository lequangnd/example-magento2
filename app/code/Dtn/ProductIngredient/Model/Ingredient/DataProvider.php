<?php

namespace Dtn\ProductIngredient\Model\Ingredient;

use Dtn\ProductIngredient\Model\ResourceModel\Ingredient\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $ingredientCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $ingredientCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();

        foreach ($items as $ingredient) {
            $this->loadedData[$ingredient->getId()] = $ingredient->getData();

            if ($ingredient->getImage()) {
                $m[0]['name'] = $ingredient->getImage();
                $m[0]['file'] = $ingredient->getImage();
                $this->loadedData[$ingredient->getId()]['image_field'] = $m;
            }
        }

        return $this->loadedData;
    }
}
