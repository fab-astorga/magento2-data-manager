<?php

namespace ConfettiInserts\Manager\Model\ResourceModel;

use ConfettiInserts\Manager\Api\Data\ConfettiInsertsPricesInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class ConfettiInsertsPrices
 */
class ConfettiInsertsPrices extends AbstractDb
{
    protected $_isPkAutoIncrement = false;
    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(ConfettiInsertsPricesInterface::TABLE, ConfettiInsertsPricesInterface::ID);
    }
}