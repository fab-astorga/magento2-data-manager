<?php

namespace DistributorTools\FlyersEblasts\Api\Data;

/**
 * Interface FlyersEblastsSearchResultsInterface
 */
interface FlyersEblastsSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \DistributorTools\FlyersEblasts\Api\Data\FlyersEblastsInterface[]
     */
    public function getItems();

    /**
     * @param \DistributorTools\FlyersEblasts\Api\Data\FlyersEblastsInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}