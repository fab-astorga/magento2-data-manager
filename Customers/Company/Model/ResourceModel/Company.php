<?php

namespace Customers\Company\Model\ResourceModel;

use \Customers\Company\Api\Data\CompanyInterface;

class Company extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init(CompanyInterface::TABLE, CompanyInterface::ID);
    }
}