<?php

namespace Dtn\ProductIngredient\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Ingredient extends AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('catalog_product_ingredient', 'ingredient_id');
    }
}
