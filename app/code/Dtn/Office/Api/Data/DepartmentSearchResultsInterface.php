<?php

namespace Dtn\Office\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface DepartmentSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return \Magento\Framework\Api\ExtensibleDataInterface[]
     */
    public function getItems();

    /**
     * @param array $items
     * @return DepartmentSearchResultsInterface
     */
    public function setItems(array $items);
}
