<?php
namespace TestOrder\Custom\Model\ResourceModel;

class Attribute extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected $__isPkAutoIncrement = false;
    
    protected function _construct()
    {
        $this->_init('order_custom_attribute', 'entity_id');
    }
}