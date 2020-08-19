<?php

namespace Customers\Wishlist\Model;

use Customers\Wishlist\Api\Data\WishlistItemInterface;
use Customers\Wishlist\Model\ResourceModel\WishlistItem as ResourceModelWishlistItem;
use \Magento\Framework\DataObject\IdentityInterface;
use \Magento\Framework\Model\AbstractExtensibleModel;

/**
 * Class Wishlist
 */
class WishlistItem extends AbstractExtensibleModel implements WishlistItemInterface
{
    const CACHE_TAG = 'wishlist_item_entity';

    /**
     * @var string
     * @codingStandardsIgnoreStart
     */
    protected $_cacheTag = 'wishlist_item_entity';
    // @codingStandardsIgnoreEnd

    /**
     * @var string
     * @codingStandardsIgnoreStart
     */
    protected $_eventPrefix = 'wishlist_item_entity';
    // @codingStandardsIgnoreEnd

    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(ResourceModelWishlistItem::class);
    }

    /**
     * @inheritdoc
     */
    public function getWishlist()
    {
        return $this->_getData(self::WISHLIST);
    }

    /**
     * @inheritdoc
     */
    public function setWishlist($wishlistId)
    {
        return $this->setData(self::WISHLIST, $wishlistId);
    }

    /**
     * @inheritdoc
     */
    public function getWishlistItem()
    {
        return $this->_getData(self::ITEM);
    }

    /**
     * @inheritdoc
     */
    public function setWishlistItem($productId)
    {
        return $this->setData(self::ITEM, $productId);
    }

}