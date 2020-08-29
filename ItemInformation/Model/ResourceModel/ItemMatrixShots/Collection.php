<?php
namespace Items\ItemInformation\Model\ResourceModel\ItemMatrixShots;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Items\ItemInformation\Model\ItemMatrixShots', 'Items\ItemInformation\Model\ResourceModel\ItemMatrixShots');
    }
}