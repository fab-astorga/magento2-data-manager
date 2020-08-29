<?php
namespace Items\ItemInformation\Model\ResourceModel\WebStoreConfiguration;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Items\ItemInformation\Model\WebStoreConfiguration', 'Items\ItemInformation\Model\ResourceModel\WebStoreConfiguration');
    }
}