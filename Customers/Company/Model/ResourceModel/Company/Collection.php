<?php
namespace Customers\Company\Model\ResourceModel\Company;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Customers\Company\Model\Company', 
                        'Customers\Company\Model\ResourceModel\Company');
    }
}