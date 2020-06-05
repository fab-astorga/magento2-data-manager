<?php

namespace Customer\Company\Api\Data;

use \Magento\Framework\Api\CustomAttributesDataInterface;
/**
 * Interface CustomerCompanyInterface
 */
interface CustomerCompanyInterface extends CustomAttributesDataInterface
{
    const TABLE                              = 'customer_company';
    const NETSUITE_ID                        = 'netsuite_id';
    const COMPANY_NAME                       = 'company_name';
    const PRICE_LEVEL                        = 'price_level';
    const INVOICE_EMAIL                      = 'invoice_email';
    const PHONE                              = 'phone';
    const ALT_PHONE                          = 'alt_phone';
    const FAX                                = 'fax';
    const ADDITIONAL_INVOICE_EMAIL_RECIPIENT = 'additional_invoice_email_recipient';

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
     * Retrieve the invoice email
     *
     * @return boolean
     */
    public function getInvoiceEmail();

    /**
     * Set invoice email
     *
     * @param boolean $invoiceEmail
     * @return $this
     */
    public function setInvoiceEmail($invoiceEmail);

    /**
     * Retrieve the phone
     *
     * @return boolean
     */
    public function getPhone();

    /**
     * Set phone
     *
     * @param boolean $phone
     * @return $this
     */
    public function setPhone($phone);

    /**
     * Retrieve the alt phone
     *
     * @return boolean
     */
    public function getAltPhone();

    /**
     * Set alt phone
     *
     * @param boolean $altPhone
     * @return $this
     */
    public function setAltPhone($altPhone);

    /**
     * Retrieve the fax
     *
     * @return boolean
     */
    public function getFax();

    /**
     * Set fax
     *
     * @param boolean $fax
     * @return $this
     */
    public function setFax($fax);

    /**
     * Retrieve the additional invoice email recipient
     *
     * @return boolean
     */
    public function getAdditionalInvoiceEmailRecipient();

    /**
     * Set additional invoice email recipient
     *
     * @param boolean $additionalInvoiceEmailRecipient
     * @return $this
     */
    public function setAdditionalInvoiceEmailRecipient($additionalInvoiceEmailRecipient);

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \Customer\Company\Api\Data\CustomerCompanyExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param \Customer\Company\Api\Data\CustomerCompanyExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(\Customer\Company\Api\Data\CustomerCompanyExtensionInterface $extensionAttributes);
}