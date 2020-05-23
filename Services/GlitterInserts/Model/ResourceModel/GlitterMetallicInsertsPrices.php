<?php

namespace Services\GlitterInserts\Model\ResourceModel;

use Services\GlitterInserts\Api\Data\GlitterMetallicInsertsPricesInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class GlitterMetallicInsertsPrices
 */
class GlitterMetallicInsertsPrices extends AbstractDb
{
    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(GlitterMetallicInsertsPricesInterface::TABLE, GlitterMetallicInsertsPricesInterface::ID);
        $this->_isPkAutoIncrement = false;
    }
}