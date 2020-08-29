<?php
namespace Items\ItemInformation\Model\ResourceModel\AdditionalDownloads;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Items\ItemInformation\Model\AdditionalDownloads', 'Items\ItemInformation\Model\ResourceModel\AdditionalDownloads');
    }
}