<?php

namespace Services\HotChocolate\Api\Data;

/**
 * Interface HotChocolateSearchResultsInterface
 */
interface HotChocolateSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Services\HotChocolate\Api\Data\HotChocolateInterface[]
     */
    public function getItems();

    /**
     * @param \Services\HotChocolate\Api\Data\HotChocolateInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}