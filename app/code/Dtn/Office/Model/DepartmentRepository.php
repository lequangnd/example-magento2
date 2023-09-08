<?php

namespace Dtn\Office\Model;

use Dtn\Office\Api\DepartmentRepositoryInterface;
use Dtn\Office\Api\Data\DepartmentInterface;
use Dtn\Office\Api\Data\DepartmentSearchResultsInterfaceFactory;
use Dtn\Office\Model\ResourceModel\Department\CollectionFactory as DepartmentCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    /**
     * @var DepartmentFactory
     */
    private $departmentFactory;

    /**
     * @var DepartmentCollectionFactory
     */
    private $departmentCollectionFactory;

    /**
     * @var DepartmentSearchResultsInterfaceFactory
     */
    private $searchResultFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;


    /**
     * DepartmentRepository constructor.
     * @param DepartmentFactory $departmentFactory
     * @param DepartmentCollectionFactory $departmentCollectionFactory
     * @param DepartmentSearchResultsInterfaceFactory $departmentSearchResultInterfaceFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        DepartmentFactory $departmentFactory,
        DepartmentCollectionFactory $departmentCollectionFactory,
        DepartmentSearchResultsInterfaceFactory $departmentSearchResultInterfaceFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->departmentCollectionFactory = $departmentCollectionFactory;
        $this->departmentFactory = $departmentFactory;
        $this->departmentCollectionFactory = $departmentCollectionFactory;
        $this->searchResultFactory = $departmentSearchResultInterfaceFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * Get department by id
     *
     * @param $id
     * @return Department
     * @throws NoSuchEntityException
     */
    public function getById($id)
    {
        $department = $this->departmentFactory->create();
        $department->getResource()->load($department, $id);
        if (!$department->getId()) {
            throw new NoSuchEntityException(__('Unable to find department with ID "%1"', $id));
        }
        return $department;
    }

    /**
     * Save department
     *
     * @param DepartmentInterface $department
     * @return DepartmentInterface
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function save(DepartmentInterface $department)
    {
        $department->getResource()->save($department);
        return $department;
    }

    /**
     * Delete department by id
     *
     * @param DepartmentInterface $department
     * @throws \Exception
     */
    public function delete(DepartmentInterface $department)
    {
        $department->getResource()->delete($department);
    }

    /**
     * Get department list
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return \Dtn\Office\Api\Data\DepartmentSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->departmentCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, ($collection));
        $searchResults = $this->searchResultFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());

        return $searchResults;
    }
}
