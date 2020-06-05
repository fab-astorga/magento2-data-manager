<?php

namespace Customer\Address\Model\ResourceModel;

use Customer\Address\Api\Data\AddressExtraAttributesInterface;

class AddressExtraAttributes extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init(AddressExtraAttributesInterface::TABLE, AddressExtraAttributesInterface::ID);
    }
}