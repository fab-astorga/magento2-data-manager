<?php

namespace Customers\Wishlist\Model\ResourceModel;

use Customers\Wishlist\Api\Data\WishlistInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Wishlist
 */
class Wishlist extends AbstractDb
{
    protected $_isPkAutoIncrement = true;
    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(WishlistInterface::TABLE, WishlistInterface::ID);
    }
}