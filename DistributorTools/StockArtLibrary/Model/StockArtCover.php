<?php

namespace DistributorTools\StockArtLibrary\Model;

use DistributorTools\StockArtLibrary\Api\Data\StockArtCoverExtensionInterface;
use DistributorTools\StockArtLibrary\Api\Data\StockArtCoverInterface;
use DistributorTools\StockArtLibrary\Model\ResourceModel\StockArtCover as ResourceModelStockArtCover;
use \Magento\Framework\DataObject\IdentityInterface;
use \Magento\Framework\Model\AbstractExtensibleModel;

/**
 * Class StockArtCover
 */
class StockArtCover extends AbstractExtensibleModel implements StockArtCoverInterface, IdentityInterface
{
    const CACHE_TAG = 'stock_art_cover_entity';

    /**
     * @var string
     * @codingStandardsIgnoreStart
     */
    protected $_cacheTag = 'stock_art_cover_entity';
    // @codingStandardsIgnoreEnd

    /**
     * @var string
     * @codingStandardsIgnoreStart
     */
    protected $_eventPrefix = 'stock_art_cover_entity';
    // @codingStandardsIgnoreEnd

    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(ResourceModelStockArtCover::class);
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->_getData(self::NAME);
    }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @inheritdoc
     */
    public function getThumbnail()
    {
        return $this->_getData(self::THUMBNAIL);
    }

    /**
     * @inheritdoc
     */
    public function setThumbnail($thumbnail)
    {
        return $this->setData(self::THUMBNAIL, $thumbnail);
    }

    /**
     * @inheritdoc
     */
    public function getImg()
    {
        return $this->_getData(self::IMG);
    }

    /**
     * @inheritdoc
     */
    public function setImg($img)
    {
        return $this->setData(self::IMG, $img);
    }

    /**
     * @inheritdoc
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * @inheritdoc
     */
    public function setExtensionAttributes(StockArtCoverExtensionInterface $extensionAttributes)
    {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}