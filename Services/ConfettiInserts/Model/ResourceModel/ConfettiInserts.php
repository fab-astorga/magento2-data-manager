<?php

namespace Services\ConfettiInserts\Model\ResourceModel;

use Services\ConfettiInserts\Api\Data\ConfettiInsertsInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class ConfettiInserts
 */
class ConfettiInserts extends AbstractDb
{
    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(ConfettiInsertsInterface::TABLE, ConfettiInsertsInterface::ID);
        $this->_isPkAutoIncrement = false;
    }
}