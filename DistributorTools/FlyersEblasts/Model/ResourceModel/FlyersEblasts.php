<?php

namespace DistributorTools\FlyersEblasts\Model\ResourceModel;

use DistributorTools\FlyersEblasts\Api\Data\FlyersEblastsInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class FlyersEblasts
 */
class FlyersEblasts extends AbstractDb
{
    protected $_isPkAutoIncrement = false;
    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(FlyersEblastsInterface::TABLE, FlyersEblastsInterface::ID);
    }
}