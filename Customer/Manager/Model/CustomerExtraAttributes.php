<?php

namespace Customer\Manager\Model;

use Customer\Manager\Api\Data\CustomerExtraAttributesExtensionInterface;

class CustomerExtraAttributes extends \Magento\Framework\Model\AbstractModel implements \Customer\Manager\Api\Data\CustomerExtraAttributesInterface
{
    protected function _construct()
    {
        $this->_init('Customer\Manager\Model\ResourceModel\CustomerExtraAttributes');
    }

    /**
     * @inheritdoc
     */
    public function setCustomerId($customerId)
    {
        return $this->setData('customer_id', $customerId);
    }

    /**
     * @inheritdoc
     */
    public function getCustomerId()
    {
        return $this->getData('customer_id');
    }

    /**
     * @inheritdoc
     */
    public function setNetsuiteId($netsuiteId)
    {
        return $this->setData('netsuite_id', $netsuiteId);
    }

    /**
     * @inheritdoc
     */
    public function getNetsuiteId()
    {
        return $this->getData('netsuite_id');
    }

    /**
     * @inheritdoc
     */
    public function setRole($role)
    {
        return $this->setData('role', $role);
    }

    /**
     * @inheritdoc
     */
    public function getRole()
    {
        return $this->getData('role');
    }

    /**
     * @inheritdoc
     */
    public function setJobTitle($jobTitle)
    {
        return $this->setData('job_title', $jobTitle);
    }

    /**
     * @inheritdoc
     */
    public function getJobTitle()
    {
        return $this->getData('job_title');
    }

    /**
     * @inheritdoc
     */
    public function setPermission($permission)
    {
        return $this->setData('permission', $permission);
    }

    /**
     * @inheritdoc
     */
    public function getPermission()
    {
        return $this->getData('permission');
    }
}