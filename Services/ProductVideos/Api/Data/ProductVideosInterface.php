<?php

namespace Services\ProductVideos\Api\Data;

/**
 * Interface ProductVideosInterface
 */
interface ProductVideosInterface
{
    const TABLE = 'product_videos';
    const ID    = 'id';
    const NAME  = 'name';
    const IMG   = 'img';    
    const VIDEO = 'video';

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
     * Retrieve image
     *
     * @return string
     */
    public function getImg();

    /**
     * Set image
     *
     * @param string $img
     * @return $this
     */
    public function setImg($img);

    /**
     * Retrieve video
     *
     * @return string
     */
    public function getVideo();

    /**
     * Set video
     *
     * @param string $video
     * @return $this
     */
    public function setVideo($video);
}