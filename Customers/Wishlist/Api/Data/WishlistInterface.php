<?php

namespace Customers\Wishlist\Api\Data;

use Magento\Framework\Api\CustomAttributesDataInterface;

/**
 * Interface StockArtCoverInterface
 */
interface WishlistInterface extends CustomAttributesDataInterface
{
    const TABLE       = 'custom_wishlist';
    const ID          = 'wishlist_id';
    const NAME        = 'name';

    /**
     * Retrieve the name
     *
     * @return string
     */
    public function getName();

    /**
     * Set name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name);

}