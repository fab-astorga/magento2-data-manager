<?php

namespace DistributorTools\StockArtLibrary\Api\Data;

use Magento\Framework\Api\CustomAttributesDataInterface;

/**
 * Interface StockArtCoverInterface
 */
interface StockArtCoverInterface extends CustomAttributesDataInterface
{
    const TABLE       = 'stock_art_cover_entity';
    const ID          = 'cover_id';
    const NAME        = 'name';
    const URL_IMAGE   = 'url_image';

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
     * Retrieve the url image
     *
     * @return string
     */
    public function getUrlImage();

    /**
     * Set url image
     *
     * @param string $urlImage
     * @return $this
     */
    public function setUrlImage($urlImage);

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