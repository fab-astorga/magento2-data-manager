<?php

namespace Customers\Contact\Plugin;

use Magento\Framework\Exception\NoSuchEntityException;

class ContactGet
{
    const CUSTOMER_ID = 'customer_id';
    const CONTACT     = 'contact';

    protected $_customerExtensionFactory;
    protected $_searchCriteriaBuilder;
    protected $_filterBuilder;
    protected $_contactRepository;
    protected $_contactFactory;
    protected $_addressExtensionFactory;
    protected $_addressDataCollection;
    protected $_customerDataRepository;
    protected $_logger;

    public function __construct (
        \Magento\Customer\Api\Data\CustomerExtensionFactory $customerExtensionFactory,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        \Customers\Contact\Api\ContactRepositoryInterface $contactRepository,
        \Customers\Contact\Model\ContactFactory $contactFactory,
        \Magento\Customer\Api\Data\AddressExtensionFactory $addressExtensionFactory,
        \Customers\Address\Model\ResourceModel\AddressData\CollectionFactory $addressDataCollection,
        \Customers\Contact\Api\CustomerDataRepositoryInterface $customerDataRepository,
        \File\CustomLog\Logger\Logger $logger
    ) {
        $this->_customerExtensionFactory = $customerExtensionFactory;
        $this->_searchCriteriaBuilder    = $searchCriteriaBuilder;
        $this->_filterBuilder            = $filterBuilder;
        $this->_contactRepository        = $contactRepository;
        $this->_contactFactory           = $contactFactory;
        $this->_addressExtensionFactory  = $addressExtensionFactory;
        $this->_addressDataCollection    = $addressDataCollection;
        $this->_customerDataRepository   = $customerDataRepository;
        $this->_logger                   = $logger;
    }

    public function afterGetContact (
        \Customers\Contact\Api\ContactManagementInterface $subject,
        \Magento\Customer\Api\Data\CustomerInterface $customer
    ) 
    {
        $customerDataEntity = $this->_customerDataRepository->get(
                                                $customer->getId(), 
                                                self::CUSTOMER_ID
                                );

        if ($customerDataEntity->getCustomerType() != self::CONTACT) {
            return 'customer is not a contact';
        }

        try {
            $contact = $this->_contactRepository->get(
                $customer->getId(),
                self::CUSTOMER_ID
            );

            if (!$contact->getId()) {
                throw new NoSuchEntityException();
            }

        } catch (NoSuchEntityException $e) {
            return $customer;
        }

        $extensionAttributes = $customer->getExtensionAttributes();
        $customerExtension = $extensionAttributes ? $extensionAttributes : $this->_customerExtensionFactory->create();
        $customerExtension->setContact($contact);
        $customer->setExtensionAttributes($customerExtension);

        /** Set address extra attributes to each address of a customer */
        foreach ($customer->getAddresses() as $address)
        {
            $collection = $this->_addressDataCollection->create();

            foreach ($collection as $addressData)
            {
                if ($address->getId() == $addressData->getAddressId())
                {
                    $extensionAttributes = $address->getExtensionAttributes();
                    $addressExtension = $extensionAttributes ? $extensionAttributes : $this->_addressExtensionFactory->create(); 
                    $addressExtension->setAddressData($addressData);
                    $address->setExtensionAttributes($addressExtension);
                }
            }    
        }

        return $customer;
    }
}