<?php
namespace Items\ItemInformation\Model\ResourceModel\NetSuiteItem;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Items\ItemInformation\Model\NetSuiteItem', 'Items\ItemInformation\Model\ResourceModel\NetSuiteItem');
    }
}