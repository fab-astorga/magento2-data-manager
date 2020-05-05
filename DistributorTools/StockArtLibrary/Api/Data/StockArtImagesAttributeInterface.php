<?php

namespace DistributorTools\StockArtLibrary\Api\Data;

/**
 * Interface StockArtImagesAttributeInterface
 */
Interface StockArtImagesAttributeInterface
{
    /** 
     * Set cover id
     * 
     * @param int $coverId
     * @return $this
     */
    public function setCoverId($coverId);

    /**
     * get cover id
     * 
     * @return int
     */
    public function getCoverId();

    /**
     * Set name
     * 
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * get name
     * 
     * @return string
     */
    public function getName();

    /**
     * Set image
     * 
     * @param string $img
     * @return $this
     */
    public function setImg($img);

    /**
     * get image
     * 
     * @return string
     */
    public function getImg();
}