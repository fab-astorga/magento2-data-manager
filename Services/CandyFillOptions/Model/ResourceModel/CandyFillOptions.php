<?php

namespace Services\CandyFillOptions\Model\ResourceModel;

use Services\CandyFillOptions\Api\Data\CandyFillOptionsInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class CandyFillOptions
 */
class CandyFillOptions extends AbstractDb
{
    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(CandyFillOptionsInterface::TABLE, CandyFillOptionsInterface::ID);
        $this->_isPkAutoIncrement = false;
    }
}