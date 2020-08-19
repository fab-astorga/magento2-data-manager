<?php

namespace Customers\Wishlist\Api\Data;

use Magento\Framework\Api\CustomAttributesDataInterface;

/**
 * Interface StockArtCoverInterface
 */
interface WishlistItemInterface extends CustomAttributesDataInterface
{
    const TABLE       = 'custom_wishlist_item';
    const ID          = 'wishlist_item_id';
    const WISHLIST    = 'wishlist_id';
    const ITEM        = 'product_id';

    /**
     * Retrieve the wishlistId
     *
     * @return int
     */
    public function getWishlist();

    /**
     * Set wishlistId
     *
     * @param int $wishlistId
     * @return $this
     */
    public function setWishlist($wishlistId);

    /**
     * Retrieve the productId
     *
     * @return int
     */
    public function getWishlistItem();

    /**
     * Set productId
     *
     * @param int $productId
     * @return $this
     */
    public function setWishlistItem($productId);
}