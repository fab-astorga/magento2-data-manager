<?php
namespace Items\ItemInformation\Model\ResourceModel\SafetyDetails;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Items\ItemInformation\Model\SafetyDetails', 'Items\ItemInformation\Model\ResourceModel\SafetyDetails');
    }
}