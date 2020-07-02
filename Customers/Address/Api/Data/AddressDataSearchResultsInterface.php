<?php

namespace Customers\Address\Api\Data;

/**
 * Interface AddressDataSearchResultsInterface
 */
interface AddressDataSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Customers\Address\Api\Data\AddressDataInterface[]
     */
    public function getItems();

    /**
     * @param \Customers\Address\Api\Data\AddressDataInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}