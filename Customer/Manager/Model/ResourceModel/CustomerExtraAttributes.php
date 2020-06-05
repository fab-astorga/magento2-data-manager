<?php

namespace Customer\Manager\Model\ResourceModel;

use Customer\Manager\Api\Data\CustomerExtraAttributesInterface;

class CustomerExtraAttributes extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init(CustomerExtraAttributesInterface::TABLE, CustomerExtraAttributesInterface::ID);
    }
}