<?php
namespace Customer\Company\Model\ResourceModel\AddressCompany;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Customer\Company\Model\AddressCompany', 
                        'Customer\Company\Model\ResourceModel\AddressCompany');
    }
}