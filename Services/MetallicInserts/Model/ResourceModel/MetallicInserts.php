<?php

namespace Services\MetallicInserts\Model\ResourceModel;

use Services\MetallicInserts\Api\Data\MetallicInsertsInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class MetallicInserts
 */
class MetallicInserts extends AbstractDb
{
    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(MetallicInsertsInterface::TABLE, MetallicInsertsInterface::ID);
        $this->_isPkAutoIncrement = false;
    }
}