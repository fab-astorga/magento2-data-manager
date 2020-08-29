<?php
namespace Items\ItemInformation\Model\ResourceModel\NetSuiteCategory;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Items\ItemInformation\Model\NetSuiteCategory', 'Items\ItemInformation\Model\ResourceModel\NetSuiteCategory');
    }
}