<?php
namespace Items\ItemInformation\Model\ResourceModel\ItemDetails;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Items\ItemInformation\Model\ItemDetails', 'Items\ItemInformation\Model\ResourceModel\ItemDetails');
    }
}