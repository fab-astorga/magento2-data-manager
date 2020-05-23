<?php

namespace Services\CandyFillOptions\Api\Data;

use Magento\Framework\Api\CustomAttributesDataInterface;

/**
 * Interface CandyFillOptionsInterface
 */
interface CandyFillOptionsInterface extends CustomAttributesDataInterface
{
    const TABLE                = 'candy_options';
    const ID                   = 'id';
    const SKU                  = 'sku';
    const NAME                 = 'name';
    const CATEGORY             = 'category';    
    const IMG                  = 'img';
    const SALES_DESCRIPTION    = 'sales_description';
    const PURCHASE_DESCRIPTION = 'purchase_description';

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
     * Retrieve category
     *
     * @return string
     */
    public function getCategory();

    /**
     * Set category
     *
     * @param string $category
     * @return $this
     */
    public function setCategory($category);

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
     * Retrieve sales description
     *
     * @return string
     */
    public function getSalesDescription();

    /**
     * Set sales description
     *
     * @param string $salesDescription
     * @return $this
     */
    public function setSalesDescription($salesDescription);

    /**
     * Retrieve purchase description
     *
     * @return string
     */
    public function getPurchaseDescription();

    /**
     * Set purchase description
     *
     * @param string $purchaseDescription
     * @return $this
     */
    public function setPurchaseDescription($purchaseDescription);

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \Services\CandyFillOptions\Api\Data\CandyFillOptionsExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param \Services\CandyFillOptions\Api\Data\CandyFillOptionsExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(\Services\CandyFillOptions\Api\Data\CandyFillOptionsExtensionInterface $extensionAttributes);
}