<?php

namespace Customer\Company\Model;

class AddressCompany extends \Magento\Framework\Model\AbstractModel implements \Customer\Company\Api\Data\AddressCompanyInterface
{
    protected function _construct()
    {
        $this->_init('Customer\Company\Model\ResourceModel\AddressCompany');
    }

    /**
     * @inheritdoc
     */
    public function setCompanyId($companyId)
    {
        return $this->setData('company_id', $companyId);
    }

    /**
     * @inheritdoc
     */
    public function getCompanyId()
    {
        return $this->getData('company_id');
    }

    /**
     * @inheritdoc
     */
    public function setAddress($address)
    {
        return $this->setData('address', $address);
    }

    /**
     * @inheritdoc
     */
    public function getAddress()
    {
        return $this->getData('address');
    }

    /**
     * @inheritdoc
     */
    public function setAptSuite($aptSuite)
    {
        return $this->setData('apt_suite', $aptSuite);
    }

    /**
     * @inheritdoc
     */
    public function getAptSuite()
    {
        return $this->getData('apt_suite');
    }

    /**
     * @inheritdoc
     */
    public function setCity($city)
    {
        return $this->setData('city', $city);
    }

    /**
     * @inheritdoc
     */
    public function getCity()
    {
        return $this->getData('city');
    }

    /**
     * @inheritdoc
     */
    public function setState($state)
    {
        return $this->setData('state', $state);
    }

    /**
     * @inheritdoc
     */
    public function getState()
    {
        return $this->getData('state');
    }

    /**
     * @inheritdoc
     */
    public function setZip($zip)
    {
        return $this->setData('zip', $zip);
    }

    /**
     * @inheritdoc
     */
    public function getZip()
    {
        return $this->getData('zip');
    }

    /**
     * @inheritdoc
     */
    public function setCountry($country)
    {
        return $this->setData('country', $country);
    }

    /**
     * @inheritdoc
     */
    public function getCountry()
    {
        return $this->getData('country');
    }

    /**
     * @inheritdoc
     */
    public function setIsDefaultMyAddress($isDefaultMyAddress)
    {
        return $this->setData('set_is_default_my_address', $isDefaultMyAddress);
    }

    /**
     * @inheritdoc
     */
    public function getIsDefaultMyAddress()
    {
        return $this->getData('set_is_default_my_address');
    }

    /**
     * @inheritdoc
     */
    public function setIsDefaultShipping($isDefaultShipping)
    {
        return $this->setData('set_is_default_shipping', $isDefaultShipping);
    }

    /**
     * @inheritdoc
     */
    public function getIsDefaultShipping()
    {
        return $this->getData('set_is_default_shipping');
    }

    /**
     * @inheritdoc
     */
    public function setIsDefaultBilling($isDefaultBilling)
    {
        return $this->setData('set_is_default_billing', $isDefaultBilling);
    }

    /**
     * @inheritdoc
     */
    public function getIsDefaultBilling()
    {
        return $this->getData('set_is_default_billing');
    }
}