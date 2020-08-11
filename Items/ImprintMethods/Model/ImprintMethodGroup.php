<?php

namespace Items\ImprintMethods\Model;

class ImprintMethodGroup extends \Magento\Framework\Model\AbstractExtensibleModel implements \Items\ImprintMethods\Api\Data\ImprintMethodGroupInterface
{
    const IMC_GROUP = 'Items\ImprintMethods\Model\ResourceModel\ImprintMethodGroup';
    
    protected function _construct()
    {
        $this->_init(self::IMC_GROUP);
    }

    /**
     * Set imprint method group netsuite id
     * 
     * @param int $netsuiteId
     * @return $this
     */
    public function setNetsuiteId($netsuiteId)
    {
        return $this->setData('netsuite_id', $netsuiteId);
    }

    /**
     * get imprint method group id
     * 
     * @return int
     */
    public function getNetsuiteId() 
    {
        return $this->getData('netsuite_id');
    }

    /**
     * Set imprint method name
     * @param string $name
     * @return $this
     */
    public function setName($name) 
    {
        return $this->setData('name', $name);
    }

    /**
     * get imprint method name
     * @return string
     */
    public function getName() 
    {
        return $this->getData('name');
    }

    /**
     * @return \Items\ImprintMethods\Api\Data\ImprintMethodGroupExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }
 
    /**
     * @param \Items\ImprintMethods\Api\Data\ImprintMethodGroupExtensionInterface $extensionAttributes
     * @return void
     */
    public function setExtensionAttributes(\Items\ImprintMethods\Api\Data\ImprintMethodGroupExtensionInterface $extensionAttributes)
    {
        return $this->_setExtensionAttributes($extensionAttributes);
    }
    
}