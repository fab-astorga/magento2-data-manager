<?php
namespace Items\ItemInformation\Model\ResourceModel;

class NetSuiteItem extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected $_isPkAutoIncrement = false;

    protected function _construct()
    {
        $this->_init('netsuite_item', 'netsuite_id');
    }
}