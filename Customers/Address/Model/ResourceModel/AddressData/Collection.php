<?php
namespace Customers\Address\Model\ResourceModel\AddressData;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Customers\Address\Model\AddressData', 
                        'Customers\Address\Model\ResourceModel\AddressData');
    }
}