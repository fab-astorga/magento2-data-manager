<?php

namespace Customers\Address\Model\ResourceModel;

use Customers\Address\Api\Data\AddressDataInterface;

class AddressData extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init(AddressDataInterface::TABLE, AddressDataInterface::ID);
    }
}