<?php

namespace ConfettiInserts\Manager\Model\ResourceModel;

use ConfettiInserts\Manager\Api\Data\ConfettiInsertsInterface;
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
    }
}