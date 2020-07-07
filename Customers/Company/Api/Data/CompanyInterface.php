<?php

namespace Customers\Company\Api\Data;

use \Magento\Framework\Api\CustomAttributesDataInterface;
/**
 * Interface CompanyInterface
 */
interface CompanyInterface extends CustomAttributesDataInterface
{
    const TABLE = 'company_customer';
    const ID    = 'id';

    /**
     * Retrieve the customer id
     *
     * @return int
     */
    public function getCustomerId();

    /**
     * Set customer id
     *
     * @param int $customerId
     * @return $this
     */
    public function setCustomerId($customerId);

    /**
     * Retrieve the netsuite id
     *
     * @return int
     */
    public function getNetsuiteId();

    /**
     * Set netsuite id
     *
     * @param int $netsuiteId
     * @return $this
     */
    public function setNetsuiteId($netsuiteId);

    /**
     * Retrieve the company name
     *
     * @return string
     */
    public function getCompanyName();

    /**
     * Set company name
     *
     * @param string $companyName
     * @return $this
     */
    public function setCompanyName($companyName);

    /**
     * Retrieve the username
     *
     * @return string
     */
    public function getUsername();

    /**
     * Set username
     * 
     * @param string $username
     * @return $this
     */
    public function setUsername($username);

    /**
     * Retrieve the primary contact
     *
     * @return string
     */
    public function getPrimaryContact();

    /**
     * Set primary contact
     * 
     * @param string $primaryContact
     * @return $this
     */
    public function setPrimaryContact($primaryContact);

    /**
     * Retrieve the job title
     *
     * @return string
     */
    public function getJobTitle();

    /**
     * Set job title
     * 
     * @param string $jobTitle
     * @return $this
     */
    public function setJobTitle($jobTitle);

    /**
     * Retrieve the invoice email
     *
     * @return string
     */
    public function getInvoiceEmail();

    /**
     * Set invoice email
     *
     * @param string $invoiceEmail
     * @return $this
     */
    public function setInvoiceEmail($invoiceEmail);

    /**
     * Retrieve the business phone
     *
     * @return string
     */
    public function getBusinessPhone();

    /**
     * Set business phone
     *
     * @param string $businessPhone
     * @return $this
     */
    public function setBusinessPhone($businessPhone);

    /**
     * Retrieve the extension
     *
     * @return string
     */
    public function getExtension();

    /**
     * Set extension
     *
     * @param string $extension
     * @return $this
     */
    public function setExtension($extension);

    /**
     * Retrieve the state sale tax license
     *
     * @return string
     */
    public function getStateSalesTaxLicense();

    /**
     * Set the state sale tax license
     *
     * @param string $stateSalesTaxLicense
     * @return $this
     */
    public function setStateSalesTaxLicense($stateSalesTaxLicense);

    /**
     * Retrieve the website address
     *
     * @return string
     */
    public function getWebsiteAddress();

    /**
     * Set website address
     *
     * @param string $websiteAddress
     * @return $this
     */
    public function setWebsiteAddress($websiteAddress);

    /**
     * Retrieve the preferred mode of delivery
     *
     * @return string
     */
    public function getPreferredModeOfDelivery();

    /**
     * Set preferred mode of delivery
     *
     * @param string $preferredModeOfDelivery
     * @return $this
     */
    public function setPreferredModeOfDelivery($preferredModeOfDelivery);

    /**
     * Retrieve 'how did you hear about us'
     *
     * @return string
     */
    public function getHowDidYouHearAboutUs();

    /**
     * Set 'how did you hear about us'
     *
     * @param string $howDidYouHearAboutUs
     * @return $this
     */
    public function setHowDidYouHearAboutUs($howDidYouHearAboutUs);

    /**
     * Retrieve the alt phone
     *
     * @return string
     */
    public function getAltPhone();

    /**
     * Set alt phone
     *
     * @param string $altPhone
     * @return $this
     */
    public function setAltPhone($altPhone);

    /**
     * Retrieve the fax
     *
     * @return string
     */
    public function getFax();

    /**
     * Set fax
     *
     * @param string $fax
     * @return $this
     */
    public function setFax($fax);

    /**
     * Retrieve the price level
     *
     * @return string
     */
    public function getPriceLevel();

    /**
     * Set price level
     *
     * @param string $priceLevel
     * @return $this
     */
    public function setPriceLevel($priceLevel);

    /**
     * Retrieve role
     *
     * @return string
     */
    public function getRole();

    /**
     * Set role
     *
     * @param string $role
     * @return $this
     */
    public function setRole($role);

    /**
     * Retrieve the additional invoice email recipient
     *
     * @return string
     */
    public function getAdditionalInvoiceEmailRecipient();

    /**
     * Set additional invoice email recipient
     *
     * @param string $additionalInvoiceEmailRecipient
     * @return $this
     */
    public function setAdditionalInvoiceEmailRecipient($additionalInvoiceEmailRecipient);

    /**
     * Retrieve permission
     *
     * @return boolean
     */
    public function getPermission();

    /**
     * Set permission
     *
     * @param boolean $permission
     * @return $this
     */
    public function setPermission($permission);

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \Customers\Company\Api\Data\CompanyExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param \Customers\Company\Api\Data\CompanyExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(\Customers\Company\Api\Data\CompanyExtensionInterface $extensionAttributes);
}