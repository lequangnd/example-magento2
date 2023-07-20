<?php

namespace Dtn\Office\Block\Employee;

use Dtn\Office\Model\ResourceModel\Department\Grid\CollectionFactory;
use Magento\Framework\View\Element\Template;

class Create extends Template
{
    public function __construct(
        Template\Context $context,
        protected CollectionFactory $departmentCollectionFactory,
        array $data = []
    )
    {
        parent::__construct($context, $data);
    }

    public function getDepartmentCollection()
    {
        return $this->departmentCollectionFactory->create();
    }

}
