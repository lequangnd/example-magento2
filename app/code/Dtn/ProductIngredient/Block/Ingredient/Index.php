<?php

namespace Dtn\ProductIngredient\Block\Ingredient;

use Dtn\ProductIngredient\Model\ResourceModel\Ingredient\CollectionFactory;
use Magento\Catalog\Block\Product\Context;
use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\ProductFactory;

class Index extends Template
{
    /**
     * @var CollectionFactory
     */
    protected $ingredientCollectionFactory;

    /**
     * @var ProductFactory
     */
    protected $productFactory;

    /**
     * Index constructor.
     * @param Context $context
     * @param CollectionFactory $ingredientCollectionFactory
     * @param ProductFactory $productFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        CollectionFactory $ingredientCollectionFactory,
        ProductFactory $productFactory,
        array $data = []
    )
    {
        $this->ingredientCollectionFactory = $ingredientCollectionFactory;
        $this->productFactory = $productFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return array
     */
    public function getIngredientCollection()
    {
        $productId = $this->getRequest()->getParam('id');
        $product = $this->productFactory->create()->load($productId);

        $ingredients = $product->getData('ingredients');
        $ingredientIds = explode(',', $ingredients);

        $ingredients = [];
        $ingredientCollection = $this->ingredientCollectionFactory->create();

        foreach ($ingredientIds as $ingredientId) {
            $ingredient = $ingredientCollection->getItemById($ingredientId);
            $ingredients[] = [
                'ingredient_id' => $ingredient->getIngredientId(),
                'name' => $ingredient->getName(),
                'image' => $ingredient->getImage()
            ];
        }

        return $ingredients;
    }
}
