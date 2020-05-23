<?php

namespace Services\HotChocolate\Api\Data;

/**
 * Interface HotChocolatePricesSearchResultsInterface
 */
interface HotChocolatePricesSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Services\HotChocolate\Api\Data\HotChocolatePricesInterface[]
     */
    public function getItems();

    /**
     * @param \Services\HotChocolate\Api\Data\HotChocolatePricesInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}