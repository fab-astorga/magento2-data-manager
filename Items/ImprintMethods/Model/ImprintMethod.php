<?php

namespace Items\ImprintMethods\Model;

class ImprintMethod extends \Magento\Framework\Model\AbstractExtensibleModel implements \Items\ImprintMethods\Api\Data\ImprintMethodInterface
{
    const IMC = 'Items\ImprintMethods\Model\ResourceModel\ImprintMethod';

    protected function _construct()
    {
        $this->_init(self::IMC);
    }

    /**
     * Set imprint method netsuite id
     * @param int $netsuiteId
     * @return $this
     */
    public function setNetsuiteId($netsuiteId)
    {
        return $this->setData('netsuite_id', $netsuiteId);
    }

    /**
     * get imprint method id
     * @return int
     */
    public function getNetsuiteId() 
    {
        return $this->getData('netsuite_id');
    }

    /**
     * Set imprint method group id
     * 
     * @param int $imcGroupId
     * @return $this
     */
    public function setImcGroupId($imcGroupId)
    {
        return $this->setData('imc_group_id', $imcGroupId);
    }

    /**
     * get imprint method group id
     * 
     * @return int
     */
    public function getImcGroupId()
    {
        return $this->getData('imc_group_id');
    }

    /**
     * Set imprint method setup item id
     * 
     * @param int $imcSetupItemId
     * @return $this
     */
    public function setImcSetupItemId($imcSetupItemId)
    {
        return $this->setData('imc_setup_item_id', $imcSetupItemId);
    }

    /**
     * get imprint method setup item id
     * 
     * @return int
     */
    public function getImcSetupItemId()
    {
        return $this->getData('imc_setup_item_id');
    }

    /**
     * Set imprint method first run item id
     * 
     * @param int $imcFirstRunItemId
     * @return $this
     */
    public function setImcFirstRunItemId($imcFirstRunItemId)
    {
        return $this->setData('imc_first_run_item_id', $imcFirstRunItemId);
    }

    /**
     * get imprint method first run item id
     * 
     * @return int
     */
    public function getImcFirstRunItemId()
    {
        return $this->getData('imc_first_run_item_id');
    }

     /**
     * Set imprint method add run item id
     * 
     * @param int $imcAddRunItemId
     * @return $this
     */
    public function setImcAddRunItemId($imcAddRunItemId)
    {
        return $this->setData('imc_add_run_item_id', $imcAddRunItemId);
    }

    /**
     * get imprint method add run item id
     * 
     * @return int
     */
    public function getImcAddRunItemId()
    {
        return $this->getData('imc_add_run_item_id');
    }

    /**
     * Set imprint method reset up item id
     * 
     * @param int $imcResetUpItemId
     * @return $this
     */
    public function setImcResetUpItemId($imcResetUpItemId)
    {
        return $this->setData('imc_reset_up_item_id', $imcResetUpItemId);
    }

    /**
     * get imprint method reset up item id
     * 
     * @return int
     */
    public function getImcResetUpItemId()
    {
        return $this->getData('imc_reset_up_item_id');
    }

    /**
     * Set imprint method exact plan item id
     * 
     * @param int $imcExactPlacItemId
     * @return $this
     */
    public function setImcExactPlacItemId($imcExactPlacItemId)
    {
        return $this->setData('imc_exact_plac_item_id', $imcExactPlacItemId);
    }

    /**
     * get imprint method exact plan item id
     * 
     * @return int
     */
    public function getImcExactPlacItemId()
    {
        return $this->getData('imc_exact_plac_item_id');
    }

    /**
     * Set imprint method pms online item id
     * 
     * @param int $imcPmsOnlineItemId
     * @return $this
     */
    public function setImcPmsOnlineItemId($imcPmsOnlineItemId)
    {
        return $this->setData('imc_pms_online_item_id', $imcPmsOnlineItemId);
    }

    /**
     * get imprint method pms online item id
     * 
     * @return int
     */
    public function getImcPmsOnlineItemId()
    {
        return $this->getData('imc_pms_online_item_id');
    }

    /**
     * Set imprint method ink change item id
     * 
     * @param int $imcInkChangeItemId
     * @return $this
     */
    public function setImcInkChangeItemId($imcInkChangeItemId)
    {
        return $this->setData('imc_ink_change_item_id', $imcInkChangeItemId);
    }

    /**
     * get imprint method ink change item id
     * 
     * @return int
     */
    public function getImcInkChangeItemId()
    {
        return $this->getData('imc_ink_change_item_id');
    }

    /**
     * Set imprint method group ltm item id
     * 
     * @param int $imcLtmItemId
     * @return $this
     */
    public function setImcLtmItemId($imcLtmItemId)
    {
        return $this->setData('imc_ltm_item_id', $imcLtmItemId);
    }

    /**
     * get imprint method group ltm item id
     * 
     * @return int
     */
    public function getImcLtmItemId()
    {
        return $this->getData('imc_ltm_item_id');
    }

    /**
     * Set imprint method group location name
     * 
     * @param string $imcLocationName
     * @return $this
     */
    public function setImcLocationName($imcLocationName)
    {
        return $this->setData('imc_location_name', $imcLocationName);
    }

    /**
     * get imprint method group location name
     * 
     * @return string
     */
    public function getImcLocationName()
    {
        return $this->getData('imc_location_name');
    }

    /**
     * Set imprint method group imprint width
     * 
     * @param string $imprintWidth
     * @return $this
     */
    public function setImprintWidth($imprintWidth)
    {
        return $this->setData('imc_imprint_width', $imprintWidth);
    }

    /**
     * get imprint method group imprint width
     * 
     * @return string
     */
    public function getImprintWidth()
    {
        return $this->getData('imc_imprint_width');
    }

    /**
     * Set imprint method group imprint height
     * 
     * @param string $imprintHeight
     * @return $this
     */
    public function setImprintHeight($imprintHeight)
    {
        return $this->setData('imc_imprint_height', $imprintHeight);
    }

    /**
     * get imprint method group imprint height
     * 
     * @return string
     */
    public function getImprintHeight()
    {
        return $this->getData('imc_imprint_height');
    }

    /**
     * @return \Items\ImprintMethods\Api\Data\ImprintMethodExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }
 
    /**
     * @param \Items\ImprintMethods\Api\Data\ImprintMethodExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(\Items\ImprintMethods\Api\Data\ImprintMethodExtensionInterface $extensionAttributes)
    {
        return $this->_setExtensionAttributes($extensionAttributes);
    }
}