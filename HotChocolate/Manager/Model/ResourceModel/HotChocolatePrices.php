<?php

namespace HotChocolate\Manager\Model\ResourceModel;

use HotChocolate\Manager\Api\Data\HotChocolatePricesInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class HotChocolatePrices
 */
class HotChocolatePrices extends AbstractDb
{
    protected $_isPkAutoIncrement = false;
    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(HotChocolatePricesInterface::TABLE, HotChocolatePricesInterface::ID);
    }
}