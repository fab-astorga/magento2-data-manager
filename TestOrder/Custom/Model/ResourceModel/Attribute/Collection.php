<?php
namespace TestOrder\Custom\Model\ResourceModel\Attribute;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('TestOrder\Custom\Model\Attribute', 'TestOrder\Custom\Model\ResourceModel\Attribute');
    }
}