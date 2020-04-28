<?php
namespace TestProduct\Custom\Model\ResourceModel;

class Attribute extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected $_isPkAutoIncrement = false;
    
    protected function _construct()
    {
        $this->_init('online_prices', 'entity_id');
    }
}