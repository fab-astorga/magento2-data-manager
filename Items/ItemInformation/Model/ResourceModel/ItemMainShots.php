<?php
namespace Items\ItemInformation\Model\ResourceModel;

class ItemMainShots extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected $_isPkAutoIncrement = false;

    protected function _construct()
    {
        $this->_init('item_main_shots', 'item_id');
    }
}