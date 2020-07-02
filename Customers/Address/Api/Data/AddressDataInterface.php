<?php

namespace Customers\Address\Api\Data;

/**
 * Interface AddressDataInterface
 */
interface AddressDataInterface
{
    const TABLE                     = 'address_data';
    const ID                        = 'id';

    /**
     * Retrieve the address id
     *
     * @return int
     */
    public function getAddressId();

    /**
     * Set address id
     *
     * @param int $addressId
     * @return $this
     */
    public function setAddressId($addressId);

     /**
     * Retrieve the netsuite id
     *
     * @return int
     */
    public function getNetsuiteId();

    /**
     * Set netsuite id
     *
     * @param int $netsuiteId
     * @return $this
     */
    public function setNetsuiteId($netsuiteId);

    /**
     * Retrieve the address
     *
     * @return string
     */
    public function getAddress();

    /**
     * Set address
     *
     * @param string $address
     * @return $this
     */
    public function setAddress($address);

    /**
     * Retrieve the apt/suite
     *
     * @return string
     */
    public function getAptSuite();

    /**
     * Set apt/suite
     *
     * @param string $aptSuite
     * @return $this
     */
    public function setAptSuite($aptSuite);

    /**
     * Retrieve the state
     *
     * @return string
     */
    public function getState();

    /**
     * Set state
     *
     * @param string $state
     * @return $this
     */
    public function setState($state);

    /**
     * Retrieve the default my address
     *
     * @return boolean
     */
    public function getIsDefaultMyAddress();

    /**
     * Set default my address
     *
     * @param boolean $isDefaultMyAddress
     * @return $this
     */
    public function setIsDefaultMyAddress($isDefaultMyAddress);
}