<?php

namespace DistributorTools\FlyersEblasts\Api\Data;

/**
 * Interface FlyersEblastsInterface
 */
interface FlyersEblastsInterface
{
    const TABLE = 'flyers_eblasts';
    const ID    = 'id';
    const NAME  = 'name';
    const IMG   = 'img';    

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
}