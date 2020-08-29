<?php
namespace Items\ItemInformation\Model\ResourceModel;

class ItemMatrixShots extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected $_isPkAutoIncrement = false;

    protected function _construct()
    {
        $this->_init('item_matrix_shots', 'item_id');
    }
}