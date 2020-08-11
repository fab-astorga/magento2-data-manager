<?php
namespace Items\ItemInformation\Model\ResourceModel\ShippingDetails;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Items\ItemInformation\Model\ShippingDetails', 'Items\ItemInformation\Model\ResourceModel\ShippingDetails');
    }
}