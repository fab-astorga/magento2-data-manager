<?php

namespace Customers\Contact\Model\ResourceModel;

use Customers\Contact\Api\Data\ContactInterface;

class Contact extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init(ContactInterface::TABLE, ContactInterface::ID);
    }
}