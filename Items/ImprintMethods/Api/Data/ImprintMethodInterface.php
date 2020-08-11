<?php
namespace Items\ImprintMethods\Api\Data;

Interface ImprintMethodInterface extends \Magento\Framework\Api\ExtensibleDataInterface 
{    
    /**
     * Set imprint method id
     * 
     * @param int $netsuiteId
     * @return $this
     */
    public function setNetsuiteId($netsuiteId);

    /**
     * get imprint method id
     * 
     * @return int
     */
    public function getNetsuiteId();

    /**
     * Set imprint method group id
     * 
     * @param int $imcGroupId
     * @return $this
     */
    public function setImcGroupId($imcGroupId);

    /**
     * get imprint method group id
     * 
     * @return int
     */
    public function getImcGroupId();

    /**
     * Set imprint method setup item id
     * 
     * @param int $imcSetupItemId
     * @return $this
     */
    public function setImcSetupItemId($imcSetupItemId);

    /**
     * get imprint method setup item id
     * 
     * @return int
     */
    public function getImcSetupItemId();

    /**
     * Set imprint method first run item id
     * 
     * @param int $imcFirstRunItemId
     * @return $this
     */
    public function setImcFirstRunItemId($imcFirstRunItemId);

    /**
     * get imprint method first run item id
     * 
     * @return int
     */
    public function getImcFirstRunItemId();

    /**
     * Set imprint method add run item id
     * 
     * @param int $imcAddRunItemId
     * @return $this
     */
    public function setImcAddRunItemId($imcAddRunItemId);

    /**
     * get imprint method add run item id
     * 
     * @return int
     */
    public function getImcAddRunItemId();

    /**
     * Set imprint method reset up item id
     * 
     * @param int $imcResetUpItemId
     * @return $this
     */
    public function setImcResetUpItemId($imcResetUpItemId);

    /**
     * get imprint method reset up item id
     * 
     * @return int
     */
    public function getImcResetUpItemId();

    /**
     * Set imprint method exact plan item id
     * 
     * @param int $imcExactPlacItemId
     * @return $this
     */
    public function setImcExactPlacItemId($imcExactPlacItemId);

    /**
     * get imprint method exact plan item id
     * 
     * @return int
     */
    public function getImcExactPlacItemId();

    /**
     * Set imprint method pms online item id
     * 
     * @param int $imcPmsOnlineItemId
     * @return $this
     */
    public function setImcPmsOnlineItemId($imcPmsOnlineItemId);

    /**
     * get imprint method pms online item id
     * 
     * @return int
     */
    public function getImcPmsOnlineItemId();

    /**
     * Set imprint method ink change item id
     * 
     * @param int $imcInkChangeItemId
     * @return $this
     */
    public function setImcInkChangeItemId($imcInkChangeItemId);

    /**
     * get imprint method ink change item id
     * 
     * @return int
     */
    public function getImcInkChangeItemId();

    /**
     * Set imprint method group ltm item id
     * 
     * @param int $imcLtmItemId
     * @return $this
     */
    public function setImcLtmItemId($imcLtmItemId);

    /**
     * get imprint method group ltm item id
     * 
     * @return int
     */
    public function getImcLtmItemId();

    /**
     * Set imprint method group location name
     * 
     * @param string $imcLocationName
     * @return $this
     */
    public function setImcLocationName($imcLocationName);

    /**
     * get imprint method group location name
     * 
     * @return string
     */
    public function getImcLocationName();

    /**
     * Set imprint method group imprint width
     * 
     * @param string $imprintWidth
     * @return $this
     */
    public function setImprintWidth($imprintWidth);

    /**
     * get imprint method group imprint width
     * 
     * @return string
     */
    public function getImprintWidth();

    /**
     * Set imprint method group imprint height
     * 
     * @param string $imprintHeight
     * @return $this
     */
    public function setImprintHeight($imprintHeight);

    /**
     * get imprint method group imprint height
     * 
     * @return string
     */
    public function getImprintHeight();

    /**
     * @return \Items\ImprintMethods\Api\Data\ImprintMethodExtensionInterface|null
     */
    public function getExtensionAttributes();
 
    /**
     * @param \Items\ImprintMethods\Api\Data\ImprintMethodExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(\Items\ImprintMethods\Api\Data\ImprintMethodExtensionInterface $extensionAttributes);
}