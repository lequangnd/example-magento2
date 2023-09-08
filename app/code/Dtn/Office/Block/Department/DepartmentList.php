<?php

namespace Dtn\Office\Block\Department;

use Dtn\Office\Model\ResourceModel\Department\CollectionFactory;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Dtn\Office\Api\DepartmentRepositoryInterface;
use Magento\Framework\View\Element\Template;

class DepartmentList extends Template
{

    /**
     * DepartmentList constructor.
     * @param Template\Context $context
     * @param CollectionFactory $departmentCollectionFactory
     * @param DepartmentRepositoryInterface $departmentRepository
     * @param SearchCriteriaBuilder $searchCriteria
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        protected CollectionFactory $departmentCollectionFactory,
        protected DepartmentRepositoryInterface $departmentRepository,
        protected SearchCriteriaBuilder $searchCriteria,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * Get department list with id < 80
     *
     * @return mixed
     */
    public function getDepartmentCollection()
    {
        $departmentSearchCriteria = $this->searchCriteria->addFilter('department_id', 80, 'lt')->create();
        $departmentList = $this->departmentRepository->getList($departmentSearchCriteria)->getItems();
        return $departmentList;
    }
}
