<?php
namespace Customer\Address\Model\ResourceModel\AddressExtraAttributes;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Customer\Address\Model\AddressExtraAttributes', 
                        'Customer\Address\Model\ResourceModel\AddressExtraAttributes');
    }
}