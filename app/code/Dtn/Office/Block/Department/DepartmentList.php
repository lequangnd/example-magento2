<?php

namespace Dtn\Office\Block\Department;

use Dtn\Office\Model\ResourceModel\Department\CollectionFactory;
use Magento\Framework\View\Element\Template;

class DepartmentList extends Template
{
    /**
     * DepartmentList constructor.
     * @param Template\Context $context
     * @param CollectionFactory $departmentCollectionFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        protected CollectionFactory $departmentCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * Get department collection
     *
     * @return \Dtn\Office\Model\ResourceModel\Department\Collection
     */
    public function getDepartmentCollection()
    {
        return $this->departmentCollectionFactory->create();
    }
}
