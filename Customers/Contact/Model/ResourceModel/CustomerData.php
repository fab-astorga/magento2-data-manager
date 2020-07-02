<?php

namespace Customers\Contact\Model\ResourceModel;

use Customers\Contact\Api\Data\CustomerDataInterface;

class CustomerData extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init(CustomerDataInterface::TABLE, CustomerDataInterface::ID);
    }
}