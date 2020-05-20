<?php

namespace ConfettiInserts\Manager\Api\Data;

/**
 * Interface ConfettiInsertsPricesSearchResultsInterface
 */
interface ConfettiInsertsPricesSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \ConfettiInserts\Manager\Api\Data\ConfettiInsertsPricesInterface[]
     */
    public function getItems();

    /**
     * @param \ConfettiInserts\Manager\Api\Data\ConfettiInsertsPricesInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}