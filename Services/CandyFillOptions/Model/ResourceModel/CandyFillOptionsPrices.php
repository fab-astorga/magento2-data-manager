<?php

namespace Services\CandyFillOptions\Model\ResourceModel;

use Services\CandyFillOptions\Api\Data\CandyFillOptionsPricesInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class CandyFillOptionsPrices
 */
class CandyFillOptionsPrices extends AbstractDb
{
    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(CandyFillOptionsPricesInterface::TABLE, CandyFillOptionsPricesInterface::ID);
        $this->_isPkAutoIncrement = false;
    }
}