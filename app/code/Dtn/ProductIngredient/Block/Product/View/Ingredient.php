<?php

namespace Dtn\ProductIngredient\Block\Product\View;

use Dtn\ProductIngredient\Model\ResourceModel\Ingredient\CollectionFactory;
use Magento\Catalog\Block\Product\Context;
use Magento\Framework\View\Element\Template;
use Magento\Catalog\Api\ProductRepositoryInterface;

class Ingredient extends Template
{
    /**
     * @var CollectionFactory
     */
    protected $ingredientCollectionFactory;

    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * Index constructor.
     * @param Context $context
     * @param CollectionFactory $ingredientCollectionFactory
     * @param ProductRepositoryInterface $productRepositoryInterface
     * @param array $data
     */
    public function __construct(
        Context $context,
        CollectionFactory $ingredientCollectionFactory,
        ProductRepositoryInterface $productRepositoryInterface,
        array $data = []
    ) {
        $this->ingredientCollectionFactory = $ingredientCollectionFactory;
        $this->productRepository = $productRepositoryInterface;
        parent::__construct($context, $data);
    }

    /**
     * @return array
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getIngredientCollection()
    {
        $productId = $this->getRequest()->getParam('id');
        $product = $this->productRepository->getById($productId);

        $ingredients = $product->getData('ingredients');
        $ingredientIds = explode(',', $ingredients);

        $ingredientsData = [];
        $ingredientCollection = $this->ingredientCollectionFactory->create();
        $ingredientCollection->addFieldToFilter('ingredient_id', ['in' => $ingredientIds]);

        foreach ($ingredientCollection as $ingredient) {
            $ingredientsData[] = [
                'ingredient_id' => $ingredient->getIngredientId(),
                'name' => $ingredient->getName(),
                'image' => $ingredient->getImage()
            ];
        }

        return $ingredientsData;
    }
}
