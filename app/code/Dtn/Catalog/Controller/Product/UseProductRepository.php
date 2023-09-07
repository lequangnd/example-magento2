<?php

namespace Dtn\Catalog\Controller\Product;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;

class UseProductRepository extends Action implements HttpGetActionInterface, HttpPostActionInterface
{
    public function __construct(
        protected Context $context,
        protected ProductRepositoryInterface $productRepository,
        protected SearchCriteriaBuilder $searchCriteria
    )
    {
        parent::__construct($context);
    }

    public function execute()
    {
        // Get Product Id
        // $product = $this->productRepository->getById(1);

        // Get Product Sku
        // $product = $this->productRepository->get('samsung');

        // Update Product
        // $product = $this->productRepository->getById(1);
        // $product->setName('Áo phông');
        // $product->save();


        // Delete Product sku
        //  $this->productRepository->deleteById('samsung');

        // Delete Product sk
        // $product = $this->productRepository->getById(1);
        // $product->delete();

        // Get Product list
        // $searchCriteria = $this->searchCriteria->create();
        // $productList = $this->productRepository->getList($searchCriteria)->getItems();
        // foreach ($productList as $product) {
        //    echo $product->getName() . "<br>";
        // }


        // Get Product id = 1
        // $searchCriteria = $this->searchCriteria->addFilter('entity_id','1','eq')->create();
        // $productCollection = $this->productRepository->getList($searchCriteria)->getItems();
        // foreach ($productCollection as $product) {
        //     echo $product->getName() . "-" . $product->getPrice();
        // }

        // Get Product id > 1
        // $searchCriteria = $this->searchCriteria->addFilter('entity_id','1','gt')->create();
        // $productCollection = $this->productRepository->getList($searchCriteria)->getItems();
        // foreach ($productCollection as $product) {
        //      echo $product->getEntityId() . "  :  " . $product->getName() . "-" . $product->getPrice() . "<br>";
        // }

        // Get Product id => 1
        // $searchCriteria = $this->searchCriteria->addFilter('entity_id','1','gteq')->create();
        // $productCollection = $this->productRepository->getList($searchCriteria)->getItems();
        // foreach ($productCollection as $product) {
        //      echo $product->getEntityId() . "  :  " . $product->getName() . "-" . $product->getPrice() . "<br>";
        // }

        // Get Product id < 9
        // $searchCriteria = $this->searchCriteria->addFilter('entity_id','9','lt')->create();
        // $productCollection = $this->productRepository->getList($searchCriteria)->getItems();
        // foreach ($productCollection as $product) {
        //     echo $product->getEntityId() . "  :  " . $product->getName() . "-" . $product->getPrice() . "<br>";
        // }

        // Get Product id <= 9
        // $searchCriteria = $this->searchCriteria->addFilter('entity_id','9','lteq')->create();
        // $productCollection = $this->productRepository->getList($searchCriteria)->getItems();
        // foreach ($productCollection as $product) {
        //      echo $product->getEntityId() . "  :  " . $product->getName() . "-" . $product->getPrice() . "<br>";
        // }

        // Get Product id 5 to 9
        // $searchCriteria = $this->searchCriteria->addFilter('entity_id', '5', 'gteq')
        //    ->addFilter('entity_id', 9, 'lteq')->create();
        // $productCollection = $this->productRepository->getList($searchCriteria)->getItems();
        // foreach ($productCollection as $product) {
        //    echo $product->getEntityId() . "  :  " . $product->getName() . "-" . $product->getPrice() . "<br>";
        // }

        // Get Product id = 5 and id = 9
        // $searchCriteria = $this->searchCriteria->addFilter('entity_id',['5','9'],'in')->create();
        // $productCollection = $this->productRepository->getList($searchCriteria)->getItems();
        // foreach ($productCollection as $product) {
        //     echo $product->getEntityId() . "  :  " . $product->getName() . "-" . $product->getPrice() . "<br>";
        // }

        // Get Product name like 'iphone'
        // $searchCriteria = $this->searchCriteria->addFilter('name','%iphone%','like')->create();
        // $productCollection = $this->productRepository->getList($searchCriteria)->getItems();
        // foreach ($productCollection as $product) {
        //     echo $product->getEntityId() . "  :  " . $product->getName() . "-" . $product->getPrice() . "<br>";
        // }

        // Get Product created_at = 2023-08-08 to created_at = 2023-08-11
        // $searchCriteria = $this->searchCriteria->addFilter('created_at', '2023-08-08', 'gteq')
        //    ->addFilter('created_at', '2023-08-11', 'lteq')->create();
        // $productCollection = $this->productRepository->getList($searchCriteria)->getItems();
        // foreach ($productCollection as $product) {
        //    echo $product->getEntityId() . "  :  " . $product->getName() . " - " . $product->getPrice() . " - " . $product->getCreatedAt() . "<br>";
        // }
    }
}
