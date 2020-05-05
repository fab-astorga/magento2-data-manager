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
    public function setCoverId($coverId)
    {
        return $this->setData('cover_id', $coverId);
    }

    /**
     * @inheritdoc
     */
    public function getCoverId()
    {
        return $this->getData('cover_id');
    }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        return $this->setData('name', $name);
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->getData('name');
    }

    /**
     * @inheritdoc
     */
    public function setImg($img)
    {
        return $this->setData('img', $img);
    }

    /**
     * @inheritdoc
     */
    public function getImg()
    {
        return $this->getData('img');
    }
}