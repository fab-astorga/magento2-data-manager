<?php
namespace Items\ItemInformation\Model\ResourceModel;

class AdditionalDownloads extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected $_isPkAutoIncrement = false;

    protected function _construct()
    {
        $this->_init('item_additional_downloads', 'item_id');
    }
}