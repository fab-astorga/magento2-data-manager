<?php

namespace Customer\Company\Api\Data;

/**
 * Interface AddressCompanyInterface
 */
interface AddressCompanyInterface
{
    const TABLE = 'address_company';
    const ID    = 'id';

    /**
     * Retrieve the company id
     *
     * @return int
     */
    public function getCompanyId();

    /**
     * Set company id
     *
     * @param int $companyId
     * @return $this
     */
    public function setCompanyId($companyId);

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
     * Retrieve the city
     *
     * @return string
     */
    public function getCity();

    /**
     * Set city
     *
     * @param string $city
     * @return $this
     */
    public function setCity($city);

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
     * Retrieve the zip
     *
     * @return string
     */
    public function getZip();

    /**
     * Set zip
     *
     * @param string $zip
     * @return $this
     */
    public function setZip($zip);

    /**
     * Retrieve the country
     *
     * @return string
     */
    public function getCountry();

    /**
     * Set country
     *
     * @param string $country
     * @return $this
     */
    public function setCountry($country);

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

    /**
     * Retrieve the default shipping
     *
     * @return boolean
     */
    public function getIsDefaultShipping();

    /**
     * Set default shipping
     *
     * @param boolean $isDefaultShipping
     * @return $this
     */
    public function setIsDefaultShipping($isDefaultShipping);

    /**
     * Retrieve the default billing
     *
     * @return boolean
     */
    public function getIsDefaultBilling();

    /**
     * Set default billing
     *
     * @param boolean $isDefaultBilling
     * @return $this
     */
    public function setIsDefaultBilling($isDefaultBilling);
}