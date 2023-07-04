<?php
namespace Dtn\Office\Block\Department;
use Dtn\Office\Model\ResourceModel\Department\CollectionFactory;
use Magento\Framework\View\Element\Template;

class DepartmentList extends Template
{
    public function __construct
    (
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
