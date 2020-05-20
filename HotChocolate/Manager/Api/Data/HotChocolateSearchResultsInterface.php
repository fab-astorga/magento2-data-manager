<?php

namespace HotChocolate\Manager\Api\Data;

/**
 * Interface HotChocolateSearchResultsInterface
 */
interface HotChocolateSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \HotChocolate\Manager\Api\Data\HotChocolateInterface[]
     */
    public function getItems();

    /**
     * @param \HotChocolate\Manager\Api\Data\HotChocolateInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}