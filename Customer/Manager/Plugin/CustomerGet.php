<?php

namespace Customer\Manager\Plugin;

use Magento\Framework\Exception\NoSuchEntityException;

class CustomerGet
{
    const CUSTOMER_ID = 'customer_id';

    protected $_customerExtensionFactory;
    protected $_customerExtraAttributesRepository;
    protected $_searchCriteriaBuilder;
    protected $_filterBuilder;
    protected $_customerExtraAttributesFactory;
    protected $_addressExtensionFactory;
    protected $_addressExtraAttributesCollection;
    protected $_logger;

    public function __construct (
        \Magento\Customer\Api\Data\CustomerExtensionFactory $customerExtensionFactory,
        \Customer\Manager\Api\CustomerExtraAttributesRepositoryInterface $customerExtraAttributesRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        \Customer\Manager\Model\CustomerExtraAttributesFactory $customerExtraAttributesFactory,
        \Magento\Customer\Api\Data\AddressExtensionFactory $addressExtensionFactory,
        \Customer\Address\Model\ResourceModel\AddressExtraAttributes\CollectionFactory $addressExtraAttributesCollection,
        \File\CustomLog\Logger\Logger $logger
    ) {
        $this->_customerExtensionFactory          = $customerExtensionFactory;
        $this->_customerExtraAttributesRepository = $customerExtraAttributesRepository;
        $this->_searchCriteriaBuilder             = $searchCriteriaBuilder;
        $this->_filterBuilder                     = $filterBuilder;
        $this->_customerExtraAttributesFactory    = $customerExtraAttributesFactory;
        $this->_addressExtensionFactory           = $addressExtensionFactory;
        $this->_addressExtraAttributesCollection  = $addressExtraAttributesCollection;
        $this->_logger                            = $logger;
    }

    public function afterGetCustomer (
        \Customer\Manager\Api\CustomerManagementInterface $subject,
        \Magento\Customer\Api\Data\CustomerInterface $customer
    ) 
    {
        try {
            $customerExtraAttributes = $this->_customerExtraAttributesRepository->get(
                $customer->getId(),
                self::CUSTOMER_ID
            );

            if (!$customerExtraAttributes->getId()) {
                throw new NoSuchEntityException();
            }

        } catch (NoSuchEntityException $e) {
            return $customer;
        }

        $extensionAttributes = $customer->getExtensionAttributes();
        $customerExtension = $extensionAttributes ? $extensionAttributes : $this->_customerExtensionFactory->create();

        $customerExtension->setCustomerExtraAttributes($customerExtraAttributes);
        $customer->setExtensionAttributes($customerExtension);

        /** Set address extra attributes to each address of a customer */
        foreach ($customer->getAddresses() as $address)
        {
            $collection = $this->_addressExtraAttributesCollection->create();

            foreach ($collection as $addressExtraAttributes)
            {
                if ($address->getId() == $addressExtraAttributes->getAddressId())
                {
                    $extensionAttributes = $address->getExtensionAttributes();
                    $addressExtension = $extensionAttributes ? $extensionAttributes : $this->_addressExtensionFactory->create(); 
                    $addressExtension->setAddressExtraAttributes($addressExtraAttributes);
                    $address->setExtensionAttributes($addressExtension);
                }
            }    
        }

        return $customer;
    }
}