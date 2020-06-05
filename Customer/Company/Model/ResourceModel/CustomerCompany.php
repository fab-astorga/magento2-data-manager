<?php

namespace Customer\Company\Model\ResourceModel;

use \Customer\Company\Api\Data\CustomerCompanyInterface;

class CustomerCompany extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init(CustomerCompanyInterface::TABLE, CustomerCompanyInterface::NETSUITE_ID);
        $this->_isPkAutoIncrement = false;
    }
}