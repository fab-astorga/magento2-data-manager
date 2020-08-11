<?php
namespace Items\ImprintMethods\Model\ResourceModel;

class ImprintMethodGroup extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected $_isPkAutoIncrement = false;

    protected function _construct()
    {
        $this->_init('imc_group_entity', 'netsuite_id');
    }
}