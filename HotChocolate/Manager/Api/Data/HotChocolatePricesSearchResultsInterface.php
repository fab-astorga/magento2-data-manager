<?php

namespace HotChocolate\Manager\Api\Data;

/**
 * Interface HotChocolatePricesSearchResultsInterface
 */
interface HotChocolatePricesSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \HotChocolate\Manager\Api\Data\HotChocolatePricesInterface[]
     */
    public function getItems();

    /**
     * @param \HotChocolate\Manager\Api\Data\HotChocolatePricesInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}