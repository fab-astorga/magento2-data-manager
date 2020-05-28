<?php

namespace Services\PmsColors\Model\ResourceModel;

use Services\PmsColors\Api\Data\PantoneListInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class PantoneList
 */
class PantoneList extends AbstractDb
{
    protected $_isPkAutoIncrement = false;
    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(PantoneListInterface::TABLE, PantoneListInterface::ID);
    }
}