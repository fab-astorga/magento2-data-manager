<?php

namespace Customers\Wishlist\Model\ResourceModel;

use Customers\Wishlist\Api\Data\WishlistItemInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class WishlistItem
 */
class WishlistItem extends AbstractDb
{
    protected $_isPkAutoIncrement = true;
    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(WishlistItemInterface::TABLE, WishlistItemInterface::ID);
    }
}