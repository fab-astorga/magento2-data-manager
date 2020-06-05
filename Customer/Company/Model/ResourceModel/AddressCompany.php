<?php

namespace Customer\Company\Model\ResourceModel;

use \Customer\Company\Api\Data\AddressCompanyInterface;

class AddressCompany extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init(AddressCompanyInterface::TABLE, AddressCompanyInterface::ID);
    }
}