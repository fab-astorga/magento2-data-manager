<?php

namespace Customers\Company\Model;

use \Customers\Company\Api\Data\CompanyExtensionInterface;
use \Customers\Company\Api\Data\CompanyInterface;
use \Magento\Framework\DataObject\IdentityInterface;
use \Magento\Framework\Model\AbstractExtensibleModel;

/**
 * Class Company
 */
class Company extends AbstractExtensibleModel implements CompanyInterface, IdentityInterface
{
    const CACHE_TAG = 'company_customer';

    /**
     * @var string
     * @codingStandardsIgnoreStart
     */
    protected $_cacheTag = 'company_customer';
    // @codingStandardsIgnoreEnd

    /**
     * @var string
     * @codingStandardsIgnoreStart
     */
    protected $_eventPrefix = 'company_customer';

    protected function _construct()
    {
        $this->_init('Customers\Company\Model\ResourceModel\Company');
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
    public function setCustomerId($customerId)
    {
        return $this->setData('customer_id', $customerId);
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
    public function setNetsuiteId($netsuiteId)
    {
        return $this->setData('netsuite_id', $netsuiteId);
    }

    /**
     * @inheritdoc
     */
    public function getCompanyName()
    {
        return $this->getData('company_name');
    }

    /**
     * @inheritdoc
     */
    public function setCompanyName($companyName)
    {
        return $this->setData('company_name', $companyName);
    }

    /**
     * @inheritdoc
     */
    public function getUsername()
    {
        return $this->getData('username');
    }

    /**
     * @inheritdoc
     */
    public function setUsername($username)
    {
        return $this->setData('username', $username);
    }

    /**
     * @inheritdoc
     */
    public function getPrimaryContact()
    {
        return $this->getData('primary_contact');
    }

    /**
     * @inheritdoc
     */
    public function setPrimaryContact($primaryContact)
    {
        return $this->setData('primary_contact', $primaryContact);
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
    public function setJobTitle($jobTitle)
    {
        return $this->setData('job_title', $jobTitle);
    }

    /**
     * @inheritdoc
     */
    public function getInvoiceEmail()
    {
        return $this->getData('invoice_email');
    }

    /**
     * @inheritdoc
     */
    public function setInvoiceEmail($invoiceEmail)
    {
        return $this->setData('invoice_email', $invoiceEmail);
    }

    /**
     * @inheritdoc
     */
    public function getBusinessPhone()
    {
        return $this->getData('business_phone');
    }

    /**
     * @inheritdoc
     */
    public function setBusinessPhone($businessPhone)
    {
        return $this->setData('business_phone', $businessPhone);
    }

    /**
     * @inheritdoc
     */
    public function getExtension()
    {
        return $this->getData('extension');
    }

    /**
     * @inheritdoc
     */
    public function setExtension($extension)
    {
        return $this->setData('extension', $extension);
    }

    /**
     * @inheritdoc
     */
    public function getStateSalesTaxLicense()
    {
        return $this->getData('state_sales_tax_license');
    }

    /**
     * @inheritdoc
     */
    public function setStateSalesTaxLicense($stateSalesTaxLicense)
    {
        return $this->setData('state_sales_tax_license', $stateSalesTaxLicense);
    }

    /**
     * @inheritdoc
     */
    public function getWebsiteAddress()
    {
        return $this->getData('website_address');
    }

    /**
     * @inheritdoc
     */
    public function setWebsiteAddress($websiteAddress)
    {
        return $this->setData('website_address', $websiteAddress);
    }

    /**
     * @inheritdoc
     */
    public function getPreferredModeOfDelivery()
    {
        return $this->getData('preferred_mode_of_delivery');
    }

    /**
     * @inheritdoc
     */
    public function setPreferredModeOfDelivery($preferredModeOfDelivery)
    {
        return $this->setData('preferred_mode_of_delivery', $preferredModeOfDelivery);
    }

    /**
     * @inheritdoc
     */
    public function getHowDidYouHearAboutUs()
    {
        return $this->getData('how_did_you_hear_about_us');
    }

    /**
     * @inheritdoc
     */
    public function setHowDidYouHearAboutUs($howDidYouHearAboutUs)
    {
        return $this->setData('how_did_you_hear_about_us', $howDidYouHearAboutUs);
    }

    /**
     * @inheritdoc
     */
    public function getAltPhone()
    {
        return $this->getData('alt_phone');
    }

    /**
     * @inheritdoc
     */
    public function setAltPhone($altPhone)
    {
        return $this->setData('alt_phone', $altPhone);
    }

    /**
     * @inheritdoc
     */
    public function getFax()
    {
        return $this->getData('fax');
    }

    /**
     * @inheritdoc
     */
    public function setFax($fax)
    {
        return $this->setData('fax', $fax);
    }

    /**
     * @inheritdoc
     */
    public function getPriceLevel()
    {
        return $this->getData('price_level');
    }

    /**
     * @inheritdoc
     */
    public function setPriceLevel($priceLevel)
    {
        return $this->setData('price_level', $priceLevel);
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
    public function setRole($role)
    {
        return $this->setData('role', $role);
    }

    /**
     * @inheritdoc
     */
    public function getAdditionalInvoiceEmailRecipient()
    {
        return $this->getData('additional_invoice_email_recipient');
    }

    /**
     * @inheritdoc
     */
    public function setAdditionalInvoiceEmailRecipient($additionalInvoiceEmailRecipient)
    {
        return $this->setData('additional_invoice_email_recipient', $additionalInvoiceEmailRecipient);
    }

    /**
     * @inheritdoc
     */
    public function getPermission()
    {
        return $this->getData('permission');
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
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * @inheritdoc
     */
    public function setExtensionAttributes(CompanyExtensionInterface $extensionAttributes)
    {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}