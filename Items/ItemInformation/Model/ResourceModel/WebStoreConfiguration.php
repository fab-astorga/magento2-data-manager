<?php
namespace Items\ItemInformation\Model\ResourceModel;

class WebStoreConfiguration extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected $_isPkAutoIncrement = false;

    protected function _construct()
    {
        $this->_init('item_web_store_configuration', 'item_id');
    }
}