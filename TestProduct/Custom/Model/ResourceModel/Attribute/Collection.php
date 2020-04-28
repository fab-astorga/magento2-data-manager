<?php

namespace TestProduct\Custom\Model\ResourceModel\Attribute;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('TestProduct\Custom\Model\Attribute', 'TestProduct\Custom\Model\ResourceModel\Attribute');
    }
}