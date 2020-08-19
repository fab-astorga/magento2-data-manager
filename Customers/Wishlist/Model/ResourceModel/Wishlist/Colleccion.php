<?php

namespace Customers\Wishlist\Model\ResourceModel\Wishlist;

use Customers\Wishlist\Model\Wishlist as WishlistModel;
use Customers\Wishlist\Model\ResourceModel\Wishlist as ResourceModelWishlist;
use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 */
class Collection extends AbstractCollection
{
    /**
     * Initialize resource model collection
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(WishlistModel::class, ResourceModelWishlist::class);
    }
}