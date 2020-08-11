<?php
namespace Items\ImprintMethods\Model\ResourceModel\ImprintMethod;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Items\ImprintMethods\Model\ImprintMethod', 'Items\ImprintMethods\Model\ResourceModel\ImprintMethod');
    }
}