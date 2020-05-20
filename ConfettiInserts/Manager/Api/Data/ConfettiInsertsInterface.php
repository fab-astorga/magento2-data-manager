<?php

namespace ConfettiInserts\Manager\Api\Data;

use Magento\Framework\Api\CustomAttributesDataInterface;

/**
 * Interface ConfettiInsertsInterface
 */
interface ConfettiInsertsInterface extends CustomAttributesDataInterface
{
    const TABLE       = 'confetti_inserts';
    const ID          = 'id';
    const SKU         = 'sku';
    const NAME        = 'name';
    const SUBCATEGORY = 'subcategory';    
    const IMG         = 'img';

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
     * Retrieve subcategory
     *
     * @return string
     */
    public function getSubcategory();

    /**
     * Set subcategory
     *
     * @param string $subcategory
     * @return $this
     */
    public function setSubcategory($subcategory);

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
     * @return \ConfettiInserts\Manager\Api\Data\ConfettiInsertsExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param \ConfettiInserts\Manager\Api\Data\ConfettiInsertsExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(\ConfettiInserts\Manager\Api\Data\ConfettiInsertsExtensionInterface $extensionAttributes);
}