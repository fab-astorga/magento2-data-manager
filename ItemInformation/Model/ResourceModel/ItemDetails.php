<?php
namespace Items\ItemInformation\Model\ResourceModel;

class ItemDetails extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected $_isPkAutoIncrement = false;

    protected function _construct()
    {
        $this->_init('item_details', 'item_id');
    }
}