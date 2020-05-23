<?php

namespace Services\MetallicInserts\Api\Data;

use Magento\Framework\Api\CustomAttributesDataInterface;

/**
 * Interface MetallicInsertsInterface
 */
interface MetallicInsertsInterface extends CustomAttributesDataInterface
{
    const TABLE = 'metallic_inserts';
    const ID    = 'id';
    const SKU   = 'sku';
    const NAME  = 'name';
    const IMG   = 'img';    

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
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \Services\MetallicInserts\Api\Data\MetallicInsertsExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param \Services\MetallicInserts\Api\Data\MetallicInsertsExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(\Services\MetallicInserts\Api\Data\MetallicInsertsExtensionInterface $extensionAttributes);
}