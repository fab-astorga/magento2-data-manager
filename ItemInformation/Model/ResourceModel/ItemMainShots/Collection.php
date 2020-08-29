<?php
namespace Items\ItemInformation\Model\ResourceModel\ItemMainShots;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Items\ItemInformation\Model\ItemMainShots', 'Items\ItemInformation\Model\ResourceModel\ItemMainShots');
    }
}