<?php

namespace Customers\Contact\Api\Data;

/**
 * Interface CustomerDataInterface
 */
interface CustomerDataInterface
{
    const TABLE        = 'customer_data';
    const ID           = 'id';

    /**
     * Retrieve the customer id
     *
     * @return int
     */
    public function getCustomerId();

    /**
     * Set customer id
     *
     * @param int $customerId
     * @return $this
     */
    public function setCustomerId($customerId);

    /**
     * Retrieve the customer type
     *
     * @return string
     */
    public function getCustomerType();

    /**
     * Set customer type
     *
     * @param string $customerType
     * @return $this
     */
    public function setCustomerType($customerType);
}