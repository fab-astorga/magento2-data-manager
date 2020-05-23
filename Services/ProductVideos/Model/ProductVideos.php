<?php

namespace Services\ProductVideos\Model;

use Services\ProductVideos\Api\Data\ProductVideosInterface;
use Services\ProductVideos\Model\ResourceModel\ProductVideos as ResourceModelProductVideos;
use \Magento\Framework\Model\AbstractExtensibleModel;

/**
 * Class ProductVideos
 */
class ProductVideos extends AbstractExtensibleModel implements ProductVideosInterface
{
    /**
     * Initialize resource model
     * @codingStandardsIgnoreStart
     */
    protected function _construct()
    {
        // @codingStandardsIgnoreEnd
        $this->_init(ResourceModelProductVideos::class);
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
    public function getVideo()
    {
        return $this->_getData(self::VIDEO);
    }

    /**
     * @inheritdoc
     */
    public function setVideo($video)
    {
        return $this->setData(self::VIDEO, $video);
    }
}