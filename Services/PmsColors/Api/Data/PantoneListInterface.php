<?php

namespace Services\PmsColors\Api\Data;

/**
 * Interface PantoneListInterface
 */
interface PantoneListInterface
{
    const TABLE       = 'pantone_list_entity';
    const ID          = 'id';
    const NAME        = 'name';
    const HEX_CODE    = 'hex_code';    
    const R           = 'r';
    const G           = 'g';
    const B           = 'b';

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
     * Retrieve the hex code
     *
     * @return string
     */
    public function getHexCode();

    /**
     * Set hex code
     *
     * @param string $hexCode
     * @return $this
     */
    public function setHexCode($hexCode);

    /**
     * Retrieve R digit from RGB code
     *
     * @return int
     */
    public function getR();

    /**
     * Set R digit from RGB code
     *
     * @param int $r
     * @return $this
     */
    public function setR($r);

    /**
     * Retrieve G digit from RGB code
     *
     * @return int
     */
    public function getG();

    /**
     * Set G digit from RGB code
     *
     * @param int $g
     * @return $this
     */
    public function setG($g);

    /**
     * Retrieve B digit from RGB code
     *
     * @return int
     */
    public function getB();

    /**
     * Set B digit from RGB code
     *
     * @param int $b
     * @return $this
     */
    public function setB($b);
}