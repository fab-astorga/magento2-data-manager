<?php

namespace Customers\Contact\Api\Data;

/**
 * Interface ContactSearchResultsInterface
 */
interface ContactSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Customers\Contact\Api\Data\ContactInterface[]
     */
    public function getItems();

    /**
     * @param \Customers\Contact\Api\Data\ContactInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}