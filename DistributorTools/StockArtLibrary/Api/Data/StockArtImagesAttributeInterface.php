<?php

namespace DistributorTools\StockArtLibrary\Api\Data;

/**
 * Interface StockArtImagesAttributeInterface
 */
Interface StockArtImagesAttributeInterface
{
    /** 
     * Set image id
     * 
     * @param int $imageId
     * @return $this
     */
    public function setImageId($imageId);

    /**
     * get image id
     * 
     * @return int
     */
    public function getImageId();

    /**
     * Set title
     * 
     * @param string $title
     * @return $this
     */
    public function setTitle($title);

    /**
     * get title
     * 
     * @return string
     */
    public function getTitle();

    /**
     * Set url image
     * 
     * @param string $urlImage
     * @return $this
     */
    public function setUrlImage($urlImage);

    /**
     * get url image
     * 
     * @return string
     */
    public function getUrlImage();
}