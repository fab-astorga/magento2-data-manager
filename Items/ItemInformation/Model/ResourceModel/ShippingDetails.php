<?php
namespace Items\ItemInformation\Model\ResourceModel;

class ShippingDetails extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected $_isPkAutoIncrement = false;

    protected function _construct()
    {
        $this->_init('item_shipping_details', 'item_id');
    }
}