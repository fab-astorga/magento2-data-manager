<?php

namespace Customer\Company\Api\Data;

/**
 * Interface AddressCompanySearchResultsInterface
 */
interface AddressCompanySearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Customer\Company\Api\Data\AddressCompanyInterface[]
     */
    public function getItems();

    /**
     * @param \Customer\Company\Api\Data\AddressCompanyInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}