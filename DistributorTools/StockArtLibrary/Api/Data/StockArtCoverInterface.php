<?php

namespace DistributorTools\StockArtLibrary\Api\Data;

use Magento\Framework\Api\CustomAttributesDataInterface;

/**
 * Interface StockArtCoverInterface
 */
interface StockArtCoverInterface extends CustomAttributesDataInterface
{
    const TABLE       = 'stock_art_cover_entity';
    const ID          = 'id';
    const NAME        = 'name';
    const THUMBNAIL   = 'thumbnail';
    const IMG         = 'img';

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

    /**
     * Retrieve the thumbnail
     *
     * @return string
     */
    public function getThumbnail();

    /**
     * Set thumbnail
     *
     * @param string $thumbnail
     * @return $this
     */
    public function setThumbnail($thumbnail);

    /**
     * Retrieve the url image
     *
     * @return string
     */
    public function getImg();

    /**
     * Set url image
     *
     * @param string $img
     * @return $this
     */
    public function setImg($img);

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \DistributorTools\StockArtLibrary\Api\Data\StockArtCoverExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param \DistributorTools\StockArtLibrary\Api\Data\StockArtCoverExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(\DistributorTools\StockArtLibrary\Api\Data\StockArtCoverExtensionInterface $extensionAttributes);
}