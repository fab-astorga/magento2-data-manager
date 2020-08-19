<?php

namespace Customers\Contact\Model;

use Customers\Contact\Api\Data\ContactExtensionInterface;

class Contact extends \Magento\Framework\Model\AbstractModel implements \Customers\Contact\Api\Data\ContactInterface
{
    protected function _construct()
    {
        $this->_init('Customers\Contact\Model\ResourceModel\Contact');
    }


    /**
     * @inheritdoc
     */
    public function setEmail($email)
    {
        return $this->setData('email', $email);
    }

    /**
     * @inheritdoc
     */
    public function getEmail()
    {
        return $this->getData('email');
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
    public function setCompanyId($companyId)
    {
        return $this->setData('company_id', $companyId);
    }

    /**
     * @inheritdoc
     */
    public function getCompanyId()
    {
        return $this->getData('company_id');
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
    public function setPhone($phone)
    {
        return $this->setData('phone', $phone);
    }

    /**
     * @inheritdoc
     */
    public function getPhone()
    {
        return $this->getData('phone');
    }

     /**
     * @inheritdoc
     */
    public function getAccess()
    {
        return $this->getData('permission');
    }

    /**
     * @inheritdoc
     */
    public function setAccess($access)
    {
        return $this->setData('access', $access);
    }
}