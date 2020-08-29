<?php
namespace Items\ItemInformation\Model\ResourceModel;

class SafetyDetails extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected $_isPkAutoIncrement = false;

    protected function _construct()
    {
        $this->_init('safety_details', 'item_id');
    }
}