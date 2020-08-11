<?php
namespace Items\ImprintMethods\Api\Data;

Interface ImprintMethodImageInterface extends \Magento\Framework\Api\ExtensibleDataInterface {
    
    /**
     * Set imprint method id
     * @param int $value
     * @return $this
     */
    public function setImprintMethodId($value);

    /**
     * get imprint method id
     * @return int
     */
    public function getImprintMethodId();

        /**
     * Set imprint method image url
     * @param string $value
     * @return $this
     */
    public function setImageURL($value);

    /**
     * get imprint method image url
     * @return string
     */
    public function getImageURL();


    /**
     * @return \Items\ImprintMethods\Api\Data\ImprintMethodImageExtensionInterface|null
     */
    public function getExtensionAttributes();
 
    /**
     * @param \Items\ImprintMethods\Api\Data\ImprintMethodImageExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(\Items\ImprintMethods\Api\Data\ImprintMethodExtensionInterface $extensionAttributes);

}