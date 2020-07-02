<?php
namespace Customers\Contact\Model\ResourceModel\Contact;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Customers\Contact\Model\Contact', 
                        'Customers\Contact\Model\ResourceModel\Contact');
    }
}