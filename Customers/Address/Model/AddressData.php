<?php

namespace Customers\Address\Model;

class AddressData extends \Magento\Framework\Model\AbstractModel implements \Customers\Address\Api\Data\AddressDataInterface
{
    protected function _construct()
    {
        $this->_init('Customers\Address\Model\ResourceModel\AddressData');
    }

    /**
     * @inheritdoc
     */
    public function setAddressId($addressId)
    {
        return $this->setData('address_id', $addressId);
    }

    /**
     * @inheritdoc
     */
    public function getAddressId()
    {
        return $this->getData('address_id');
    }

    /**
     * @inheritdoc
     */
    public function setNetsuiteId($netsuiteId)
    {
        return $this->setData('netsuite_id', $netsuiteId);
    }

    /**
     * @inheritdoc
     */
    public function getNetsuiteId()
    {
        return $this->getData('netsuite_id');
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
}