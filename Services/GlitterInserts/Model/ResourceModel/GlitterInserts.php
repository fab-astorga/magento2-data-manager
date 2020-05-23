<?php

namespace Services\GlitterInserts\Model\ResourceModel;

use Services\GlitterInserts\Api\Data\GlitterInsertsInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class GlitterInserts
 */
class GlitterInserts extends AbstractDb
{
    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(GlitterInsertsInterface::TABLE, GlitterInsertsInterface::ID);
        $this->_isPkAutoIncrement = false;
    }
}