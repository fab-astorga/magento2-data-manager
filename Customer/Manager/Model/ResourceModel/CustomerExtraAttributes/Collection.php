<?php
namespace Customer\Manager\Model\ResourceModel\CustomerExtraAttributes;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Customer\Manager\Model\CustomerExtraAttributes', 
                        'Customer\Manager\Model\ResourceModel\CustomerExtraAttributes');
    }
}