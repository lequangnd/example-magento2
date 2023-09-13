<?php

namespace Dtn\ProductIngredient\Controller\Adminhtml\Ingredient;

use Dtn\ProductIngredient\Model\IngredientFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\View\Result\PageFactory;

class EditPost extends Action implements HttpPostActionInterface
{
    /**
     * EditPost constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param IngredientFactory $ingredientFactory
     */
    public function __construct(
        protected Context $context,
        protected PageFactory $resultPageFactory,
        protected IngredientFactory $ingredientFactory,
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        if ($this->getRequest()->isPost()) {
            $postData = $this->getRequest()->getPostValue();

            $ingredientId = $postData['ingredient_id'];
            $name = $postData['name'];
            $images = $postData['image_field'];
            $image = $images['0']['file'];

            $ingredient = $this->ingredientFactory->create();
            $ingredient->load($ingredientId);
            $ingredient->setName($name);
            $ingredient->setImage($image);
            $ingredient->save();

            $this->messageManager->addSuccessMessage(__('Edit Ingredient Successful'));
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        }
    }
}
