<?php

namespace Customer\Manager\Api\Data;

/**
 * Interface CustomerExtraAttributesSearchResultsInterface
 */
interface CustomerExtraAttributesSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Customer\Manager\Api\Data\CustomerExtraAttributesInterface[]
     */
    public function getItems();

    /**
     * @param \Customer\Manager\Api\Data\CustomerExtraAttributesInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}