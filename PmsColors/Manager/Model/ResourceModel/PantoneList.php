<?php

namespace PmsColors\Manager\Model\ResourceModel;

use PmsColors\Manager\Api\Data\PantoneListInterface;
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
        $this->_init(PantoneListInterface::TABLE, PantoneListInterface::INTERNAL_ID);
    }
}