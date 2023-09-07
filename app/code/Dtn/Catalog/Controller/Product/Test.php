<?php

namespace Dtn\Catalog\Controller\Product;

use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;

class Test extends Action implements HttpGetActionInterface, HttpPostActionInterface
{
    public function __construct(
        protected Context $context,
        protected ProductFactory $productFactory,
        protected CollectionFactory $productCollectionFactory
    )
    {
        parent::__construct($context);
    }

    public function execute()
    {
        // Get Product Id
        // $product = $this->productFactory->create()->load(1);

        // Get Product Sku
        // $product = $this->productFactory->create()->loadByAttribute('sku','samsung');

        // Update Product
        // $product->setName('Áo phông nam 123');
        // $product->save();

        // Delete Product
        // $product->delete();

        // Get Product list
        // $productCollection = $this->productCollectionFactory->create();
        // $productCollection->addAttributeToSelect(['name', 'price']);
        // foreach ($productCollection as $product) {
        //     echo $product->getName() . "-" . $product->getPrice() . "<br>";
        // }

        // Get Product id = 1
        // $productCollection = $this->productCollectionFactory->create();
        // $productCollection->addAttributeToFilter('entity_id', ['eq' => 1]);
        // $productCollection->addAttributeToSelect(['name', 'price']);
        // foreach ($productCollection as $product) {
        //     echo $product->getName() . "-" . $product->getPrice();
        // }

        // Get Product id > 1
        // $productCollection = $this->productCollectionFactory->create();
        // $productCollection->addAttributeToFilter('entity_id', ['gt' => 1]);
        // $productCollection->addAttributeToSelect(['name', 'price']);
        // foreach ($productCollection as $product) {
        //    echo $product->getEntityId() . "  :  " . $product->getName() . "-" . $product->getPrice() . "<br>";
        // }

        // Get Product id => 1
        // $productCollection = $this->productCollectionFactory->create();
        // $productCollection->addAttributeToFilter('entity_id', ['gteq' => 1]);
        // $productCollection->addAttributeToSelect(['name', 'price']);
        // foreach ($productCollection as $product) {
        //    echo $product->getEntityId() . "  :  " . $product->getName() . "-" . $product->getPrice() . "<br>";
        // }

        // Get Product id < 9
        // $productCollection = $this->productCollectionFactory->create();
        // $productCollection->addAttributeToFilter('entity_id', ['lt' => 9]);
        // $productCollection->addAttributeToSelect(['name', 'price']);
        // foreach ($productCollection as $product) {
        //    echo $product->getEntityId() . "  :  " . $product->getName() . "-" . $product->getPrice() . "<br>";
        // }

        // Get Product id <= 9
        // $productCollection = $this->productCollectionFactory->create();
        // $productCollection->addAttributeToFilter('entity_id', ['lteq' => 9]);
        // $productCollection->addAttributeToSelect(['name', 'price']);
        // foreach ($productCollection as $product) {
        //    echo $product->getEntityId() . "  :  " . $product->getName() . "-" . $product->getPrice() . "<br>";
        // }

        // Get Product id 3 to 9
        // $productCollection = $this->productCollectionFactory->create();
        // $productCollection->addAttributeToFilter('entity_id', ['from' => '5', 'to' => '9']);
        // $productCollection->addAttributeToSelect(['name', 'price']);
        // foreach ($productCollection as $product) {
        //    echo $product->getEntityId() . "  :  " . $product->getName() . "-" . $product->getPrice() . "<br>";
        // }

        // Get Product id = 5 and id = 9
        // $productCollection = $this->productCollectionFactory->create();
        // $productCollection->addAttributeToFilter('entity_id', ['in' => ['5','9']]);
        // $productCollection->addAttributeToSelect(['name', 'price']);
        // foreach ($productCollection as $product) {
        //    echo $product->getEntityId() . "  :  " . $product->getName() . "-" . $product->getPrice() . "<br>";
        // }

        // Get Product name like 'iphone'
        // $productCollection = $this->productCollectionFactory->create();
        // $productCollection->addAttributeToSelect(['name', 'price']);
        // $productCollection->addAttributeToFilter('name', ['like' => '%iphone%']);
        // foreach ($productCollection as $product) {
        //    echo $product->getEntityId() . "  :  " . $product->getName() . "-" . $product->getPrice() . "<br>";
        // }

    }
}

