<?php
namespace Customers\Contact\Model\ResourceModel\CustomerData;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Customers\Contact\Model\CustomerData', 
                        'Customers\Contact\Model\ResourceModel\CustomerData');
    }
}