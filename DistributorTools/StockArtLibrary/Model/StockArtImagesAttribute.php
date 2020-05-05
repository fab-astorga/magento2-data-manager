<?php

namespace DistributorTools\StockArtLibrary\Model;

use DistributorTools\StockArtLibrary\Api\Data\StockArtImagesAttributeExtensionInterface;

class StockArtImagesAttribute extends \Magento\Framework\Model\AbstractModel implements \DistributorTools\StockArtLibrary\Api\Data\StockArtImagesAttributeInterface
{
    protected function _construct()
    {
        $this->_init('DistributorTools\StockArtLibrary\Model\ResourceModel\StockArtImagesAttribute');
    }

    /**
     * @inheritdoc
     */
    public function setImageId($imageId)
    {
        return $this->setData('image_id', $imageId);
    }

    /**
     * @inheritdoc
     */
    public function getImageId()
    {
        return $this->getData('image_id');
    }

    /**
     * @inheritdoc
     */
    public function setTitle($title)
    {
        return $this->setData('title', $title);
    }

    /**
     * @inheritdoc
     */
    public function getTitle()
    {
        return $this->getData('title');
    }

    /**
     * @inheritdoc
     */
    public function setUrlImage($urlImage)
    {
        return $this->setData('url_image', $urlImage);
    }

    /**
     * @inheritdoc
     */
    public function getUrlImage()
    {
        return $this->getData('url_image');
    }
}