<?php

namespace Dtn\Office\Controller\Adminhtml\Department;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use Dtn\Office\Model\ResourceModel\Department\Grid\CollectionFactory;

class MassDelete extends Action
{
    protected $departmentCollectionFactory;
    protected $filter;

    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
    )
    {
        $this->filter = $filter;
        $this->departmentCollectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->departmentCollectionFactory->create());

            $count = 0;

            foreach ($collection as $item) {
                $deleteItem = $this->_objectManager->get('Dtn\Office\Model\Department')->load($item->getId());
                $deleteItem->delete();
                $count++;
            }
            $this->messageManager->addSuccess(__('A total of %1 Department(s) have been deleted.', $count));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');
    }

}
