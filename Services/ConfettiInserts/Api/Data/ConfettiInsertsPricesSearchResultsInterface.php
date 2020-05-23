<?php

namespace Services\ConfettiInserts\Api\Data;

/**
 * Interface ConfettiInsertsPricesSearchResultsInterface
 */
interface ConfettiInsertsPricesSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Services\ConfettiInserts\Api\Data\ConfettiInsertsPricesInterface[]
     */
    public function getItems();

    /**
     * @param \Services\ConfettiInserts\Api\Data\ConfettiInsertsPricesInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}