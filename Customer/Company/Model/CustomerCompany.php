<?php

namespace Customer\Company\Model;

use \Customer\Company\Api\Data\CustomerCompanyExtensionInterface;
use \Customer\Company\Api\Data\CustomerCompanyInterface;
use \Magento\Framework\DataObject\IdentityInterface;
use \Magento\Framework\Model\AbstractExtensibleModel;

/**
 * Class CustomerCompany
 */
class CustomerCompany extends AbstractExtensibleModel implements CustomerCompanyInterface, IdentityInterface
{
    const CACHE_TAG = 'customer_company';

    /**
     * @var string
     * @codingStandardsIgnoreStart
     */
    protected $_cacheTag = 'customer_company';
    // @codingStandardsIgnoreEnd

    /**
     * @var string
     * @codingStandardsIgnoreStart
     */
    protected $_eventPrefix = 'customer_company';

    protected function _construct()
    {
        $this->_init('Customer\Company\Model\ResourceModel\CustomerCompany');
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
    public function getPhone()
    {
        return $this->getData('phone');
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
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * @inheritdoc
     */
    public function setExtensionAttributes(CustomerCompanyExtensionInterface $extensionAttributes)
    {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}