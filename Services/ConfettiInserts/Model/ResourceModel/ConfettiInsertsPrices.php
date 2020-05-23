<?php

namespace Services\ConfettiInserts\Model\ResourceModel;

use Services\ConfettiInserts\Api\Data\ConfettiInsertsPricesInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class ConfettiInsertsPrices
 */
class ConfettiInsertsPrices extends AbstractDb
{
    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(ConfettiInsertsPricesInterface::TABLE, ConfettiInsertsPricesInterface::ID);
        $this->_isPkAutoIncrement = false;
    }
}