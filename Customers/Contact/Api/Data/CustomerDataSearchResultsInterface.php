<?php

namespace Customers\Contact\Api\Data;

/**
 * Interface CustomerDataSearchResultsInterface
 */
interface CustomerDataSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Customers\Contact\Api\Data\CustomerDataInterface[]
     */
    public function getItems();

    /**
     * @param \Customers\Contact\Api\Data\CustomerDataInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}