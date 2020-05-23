<?php

namespace Services\HotChocolate\Model\ResourceModel;

use Services\HotChocolate\Api\Data\HotChocolateInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class HotChocolate
 */
class HotChocolate extends AbstractDb
{
    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(HotChocolateInterface::TABLE, HotChocolateInterface::ID);
        $this->_isPkAutoIncrement = false;
    }
}