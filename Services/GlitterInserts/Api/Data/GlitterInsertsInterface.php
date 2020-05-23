<?php

namespace Services\GlitterInserts\Api\Data;

use Magento\Framework\Api\CustomAttributesDataInterface;

/**
 * Interface GlitterInsertsInterface
 */
interface GlitterInsertsInterface extends CustomAttributesDataInterface
{
    const TABLE = 'glitter_inserts';
    const ID    = 'id';
    const SKU   = 'sku';
    const NAME  = 'name';
    const IMG   = 'img';    
    const TYPE  = 'type';

    /**
     * Retrieve the sku
     *
     * @return string
     */
    public function getSku();

    /**
     * Set sku
     *
     * @param string $sku
     * @return $this
     */
    public function setSku($sku);

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
    public function getImg();

    /**
     * Set url image
     *
     * @param string $img
     * @return $this
     */
    public function setImg($img);

    /**
     * Retrieve type
     *
     * @return string
     */
    public function getType();

    /**
     * Set type
     *
     * @param string $type
     * @return $this
     */
    public function setType($type);

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \Services\GlitterInserts\Api\Data\GlitterInsertsExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param \Services\GlitterInserts\Api\Data\GlitterInsertsExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(\Services\GlitterInserts\Api\Data\GlitterInsertsExtensionInterface $extensionAttributes);
}