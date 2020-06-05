<?php
namespace Customer\Company\Model\ResourceModel\CustomerCompany;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Customer\Company\Model\CustomerCompany', 
                        'Customer\Company\Model\ResourceModel\CustomerCompany');
    }
}