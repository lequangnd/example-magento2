<?php

namespace Dtn\ProductIngredient\Model\ResourceModel\Ingredient;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(\Dtn\ProductIngredient\Model\Ingredient::class, \Dtn\ProductIngredient\Model\ResourceModel\Ingredient::class);
    }
}
