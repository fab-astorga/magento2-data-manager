<?php

namespace Customers\Wishlist\Model\ResourceModel\WishlistItem;

use Customers\Wishlist\Model\WishlistItem as WishlistItemModel;
use Customers\Wishlist\Model\ResourceModel\WishlistItem as ResourceModelWishlistItem;
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
        $this->_init(WishlistItemModel::class, ResourceModelWishlistItem::class);
    }
}