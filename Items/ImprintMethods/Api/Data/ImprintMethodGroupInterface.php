<?php
namespace Items\ImprintMethods\Api\Data;

Interface ImprintMethodGroupInterface extends \Magento\Framework\Api\ExtensibleDataInterface 
{    
    /**
     * Set imprint method group id
     * 
     * @param int $netsuiteId
     * @return $this
     */
    public function setNetsuiteId($netsuiteId);

    /**
     * get imprint method group id
     * 
     * @return int
     */
    public function getNetsuiteId();

        /**
     * Set imprint method group name
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * get imprint method group name
     * @return string
     */
    public function getName();

    /**
     * @return \Items\ImprintMethods\Api\Data\ImprintMethodGroupExtensionInterface|null
     */
    public function getExtensionAttributes();
 
    /**
     * @param \Items\ImprintMethods\Api\Data\ImprintMethodGroupExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(\Items\ImprintMethods\Api\Data\ImprintMethodGroupExtensionInterface $extensionAttributes);
}