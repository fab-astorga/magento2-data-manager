<?php

namespace ConfettiInserts\Manager\Api\Data;

/**
 * Interface ConfettiInsertsSearchResultsInterface
 */
interface ConfettiInsertsSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \ConfettiInserts\Manager\Api\Data\ConfettiInsertsInterface[]
     */
    public function getItems();

    /**
     * @param \ConfettiInserts\Manager\Api\Data\ConfettiInsertsInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}