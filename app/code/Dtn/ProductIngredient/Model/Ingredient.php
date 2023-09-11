<?php

namespace Dtn\ProductIngredient\Model;

use Magento\Framework\Model\AbstractModel;

class Ingredient extends AbstractModel
{

    protected function _construct()
    {
        $this->_init(\Dtn\ProductIngredient\Model\ResourceModel\Ingredient::class);
    }
}
