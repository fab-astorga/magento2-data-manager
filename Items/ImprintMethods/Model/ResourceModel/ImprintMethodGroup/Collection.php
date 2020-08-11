<?php
namespace Items\ImprintMethods\Model\ResourceModel\ImprintMethodGroup;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Items\ImprintMethods\Model\ImprintMethodGroup', 'Items\ImprintMethods\Model\ResourceModel\ImprintMethodGroup');
    }
}