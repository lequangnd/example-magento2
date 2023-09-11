<?php

namespace Dtn\Office\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Dtn\Office\Api\Data\DepartmentInterface;

interface DepartmentRepositoryInterface
{
    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * @param DepartmentInterface $department
     * @return mixed
     */
    public function save(DepartmentInterface $department);

    /**
     * @param DepartmentInterface $department
     * @return mixed
     */
    public function delete(DepartmentInterface $department);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return mixed
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
