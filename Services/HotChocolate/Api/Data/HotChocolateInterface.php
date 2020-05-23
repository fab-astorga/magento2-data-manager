<?php

namespace Services\HotChocolate\Api\Data;

use Magento\Framework\Api\CustomAttributesDataInterface;

/**
 * Interface HotChocolateInterface
 */
interface HotChocolateInterface extends CustomAttributesDataInterface
{
    const TABLE                = 'hot_chocolate';
    const ID                   = 'id';
    const SKU                  = 'sku';
    const NAME                 = 'name';
    const SALES_DESCRIPTION    = 'sales_description';    
    const IMG                  = 'img';
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
     * @return \Services\HotChocolate\Api\Data\HotChocolateExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param \Services\HotChocolate\Api\Data\HotChocolateExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(\Services\HotChocolate\Api\Data\HotChocolateExtensionInterface $extensionAttributes);
}