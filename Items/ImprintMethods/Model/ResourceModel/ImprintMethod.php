<?php
namespace Items\ImprintMethods\Model\ResourceModel;

class ImprintMethod extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected $_isPkAutoIncrement = false;

    protected function _construct()
    {
        $this->_init('imc_entity', 'netsuite_id');
    }
}