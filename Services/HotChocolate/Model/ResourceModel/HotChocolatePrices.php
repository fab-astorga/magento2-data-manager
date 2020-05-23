<?php

namespace Services\HotChocolate\Model\ResourceModel;

use Services\HotChocolate\Api\Data\HotChocolatePricesInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class HotChocolatePrices
 */
class HotChocolatePrices extends AbstractDb
{
    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(HotChocolatePricesInterface::TABLE, HotChocolatePricesInterface::ID);
        $this->_isPkAutoIncrement = false;
    }
}