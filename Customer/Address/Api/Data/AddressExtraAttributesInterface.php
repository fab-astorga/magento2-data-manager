<?php

namespace Customer\Address\Api\Data;

/**
 * Interface AddressExtraAttributesInterface
 */
interface AddressExtraAttributesInterface
{
    const TABLE                     = 'address_extra_attributes';
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