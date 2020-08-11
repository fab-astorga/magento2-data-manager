<?php

namespace Items\ImprintMethods\Api\Data;

/**
 * Interface ImprintMethodSearchResultsInterface
 */
interface ImprintMethodSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Items\ImprintMethods\Api\Data\ImprintMethodInterface[]
     */
    public function getItems();

    /**
     * @param \Items\ImprintMethods\Api\Data\ImprintMethodInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}