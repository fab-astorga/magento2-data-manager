<?php

namespace Customer\Address\Api\Data;

/**
 * Interface AddressExtraAttributesSearchResultsInterface
 */
interface AddressExtraAttributesSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Customer\Address\Api\Data\AddressExtraAttributesInterface[]
     */
    public function getItems();

    /**
     * @param \Customer\Address\Api\Data\AddressExtraAttributesInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}