<?php

namespace Customers\Contact\Model;

use Exception;
use Customers\Contact\Api\ContactManagementInterface;

class ContactManagement implements ContactManagementInterface 
{
    const DEFAULT = 'default';
    const CONTACT = 'contact';

    protected $_storeManager;
    protected $_customerInterface;
    protected $_encryptor;
    protected $_customerRepository;
    protected $_customerFactory;
    protected $_customerExtensionFactory;
    protected $_sessionFactory;
    protected $_accountManagement;
    protected $_addressRepository;
    protected $_addressDataFactory;
    protected $_contactRepository;
    protected $_addressDataRepository;
    protected $_addressExtensionFactory;
    protected $_customerCollection;
    protected $_addressDataCollection;
    protected $_customerDataRepository;
  //  protected $_companyRepository;
    protected $_logger;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Customer\Api\Data\CustomerInterfaceFactory $customerInterface,
        \Magento\Framework\Encryption\EncryptorInterface $encryptor,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Customer\Api\Data\CustomerExtensionFactory $customerExtensionFactory,
        \Magento\Customer\Model\SessionFactory $sessionFactory,
        \Magento\Customer\Api\AccountManagementInterface $accountManagement,
        \Magento\Customer\Api\AddressRepositoryInterface $addressRepository,
        \Magento\Customer\Api\Data\AddressInterfaceFactory $addressDataFactory,
        \Magento\Customer\Api\Data\AddressExtensionFactory $addressExtensionFactory,
        \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $customerCollection,
        \Customers\Contact\Api\ContactRepositoryInterface $contactRepository,
        \Customers\Address\Api\AddressDataRepositoryInterface $addressDataRepository,
        \Customers\Address\Model\ResourceModel\AddressData\CollectionFactory $addressDataCollection,
        \Customers\Contact\Api\CustomerDataRepositoryInterface $customerDataRepository,
       // \Customers\Company\Api\CompanyRepositoryInterface $companyRepository,
        \File\CustomLog\Logger\Logger $logger
    ) 
    {
        $this->_storeManager                      = $storeManager;
        $this->_customerInterface                 = $customerInterface;
        $this->_encryptor                         = $encryptor;
        $this->_customerRepository                = $customerRepository;
        $this->_customerFactory                   = $customerFactory;
        $this->_customerExtensionFactory          = $customerExtensionFactory;
        $this->_sessionFactory                    = $sessionFactory;
        $this->_accountManagement                 = $accountManagement;
        $this->_addressRepository                 = $addressRepository;
        $this->_addressDataFactory                = $addressDataFactory;
        $this->_addressExtensionFactory           = $addressExtensionFactory;
        $this->_customerCollection                = $customerCollection;
        $this->_contactRepository                 = $contactRepository;
        $this->_addressDataRepository             = $addressDataRepository;
        $this->_addressDataCollection             = $addressDataCollection;
        $this->_customerDataRepository            = $customerDataRepository;
     //   $this->_companyRepository                 = $companyRepository;
        $this->_logger                            = $logger;
    }

    /**
     * {@inheritdoc}
     * 
     */
    public function registerContactTest() 
    {
        $email = 'csolano@gmail.com';
        $firstname = 'catalina';
        $lastname = 'solano';
        $password = 'csolano';
        $netsuiteId = 5557;
        $companyId = 1111;
        $jobTitle = 'Dr';
        
        $shippingAddress = array(
            "zip"=>33101, 
            "country"=>"US",
            "address"=>"Miami", 
            "city"=>"Florida", 
            "apt_suite"=>"4",                                
            "state"=>"whatever",                               
            "set_is_default_my_address"=>false,
            "set_is_default_billing"=>true, 
            "set_is_default_shipping"=>false
        );

        $billingAddress = array(
            "zip"=>10001, 
            "country"=>"US",
            "address"=>"New York", 
            "city"=>"New York", 
            "apt_suite"=>"7",                                
            "state"=>"whatever",                               
            "set_is_default_my_address"=>false,
            "set_is_default_billing"=>false, 
            "set_is_default_shipping"=>true
        );

        $addresses = array($shippingAddress, $billingAddress);

        $isRegistered = $this->registerContact(
                $email, 
                $firstname, 
                $lastname, 
                $password, 
                $netsuiteId, 
                $companyId,
                $jobTitle, 
                $addresses
            );

        return $isRegistered;
    }

    public function registerContact(
        $email, 
        $firstname, 
        $lastname, 
        $password, 
        $netsuiteId, 
        $companyId,
        $jobTitle, 
        $addresses
    )
    {
        /* Hacer el request a Netsuite con todos los datos
         Recibir el netsuite id y guardarlo en una variable 
        para luego ejecutar el código de abajo y crear las entidades */

        $storeId = $this->_storeManager->getStore()->getId();
        $websiteId = $this->_storeManager->getStore($storeId)->getWebsiteId();

        try {

           // if ($this->_companyRepository->getById($companyId))
          //  {
                $contact = $this->_customerInterface->create();
                $contact->setWebsiteId($websiteId);
                $contact->setEmail($email);
                $contact->setFirstname($firstname);
                $contact->setLastname($lastname);
                $hashedPassword = $this->_encryptor->getHash($password, true);

                $this->_customerRepository->save($contact, $hashedPassword);
                $contact = $this->_customerFactory->create();
                $contact->setWebsiteId($websiteId)->loadByEmail($email);

                $this->_customerDataRepository->save(
                    $contact->getId(),
                    self::CONTACT
                );

                $this->_contactRepository->save( 
                    $netsuiteId,
                    $contact->getId(),
                    $companyId,
                    $jobTitle
                );

                foreach ($addresses as $tmpAddress)
                {
                    $address = $this->_addressDataFactory->create();
                    // Required values for entity
                    $address->setFirstname($firstname);
                    $address->setLastname($lastname);
                    $address->setTelephone(self::DEFAULT);
                    $street[] = self::DEFAULT;
                    $address->setStreet($street);
                    $address->setCity($tmpAddress['city']);
                    $address->setCountryId($tmpAddress['country']);
                    $address->setPostcode($tmpAddress['zip']);
                    $address->setIsDefaultShipping($tmpAddress['set_is_default_shipping']);
                    $address->setIsDefaultBilling($tmpAddress['set_is_default_billing']);
                    $address->setCustomerId($contact->getId());
                    $this->_addressRepository->save($address);
                    
                    $addressData = $this->_addressDataRepository->save(
                                                $address->getId(),
                                                null,
                                                $tmpAddress['address'],
                                                $tmpAddress['apt_suite'],
                                                $tmpAddress['state'],
                                                $tmpAddress['set_is_default_my_address']
                                            ); 
                }

                $customer = $this->_customerRepository->get($email);

                return $customer;

         /*   } else {
                    return false;
            } */

        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * {@inheritdoc}
     * 
     */
    public function getContact($email)
    {
        $customer = $this->_customerRepository->get($email);
        return $customer;   
        
    }

    /**
     * {@inheritdoc}
     */
    public function getAllContacts()
    {
        $collection = $this->_customerCollection->create();
        $contacts = array();

        foreach ($collection as $item)
        {
            $contact = $this->getContact($item->getEmail());
            if (!is_string($contact)) {
                $contacts[] = $contact;
            }  
        }

        return $contacts;
    }

    /**
     * {@inheritdoc}
     * 
     */
    public function deleteContact($email)
    {
        try {
            $contact = $this->_customerRepository->get($email);
            $this->_customerRepository->delete($contact);
            return true;

        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * {@inheritdoc}
     * 
     */
    public function updateContact($email, $firstname, $lastname)
    {
        try {
            $contact = $this->getContact($email);

            if($contact->getId())
            {
                $contact->setFirstname($firstname);
                $contact->setLastname($lastname);
            }
            $this->_customerRepository->save($contact);

            return true;

        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * {@inheritdoc}
     * 
     */
    public function changePasswordContact($email, $actualPassword, $newPassword)
    {
        try {
            $contact = $this->getContact($email);

            if($contact->getId())  {
                $this->_accountManagement->changePassword (
                    $email,
                    $actualPassword,
                    $newPassword 
                );

                return true;
            }
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * {@inheritdoc}
     * 
     */
    public function loginContact($email, $password)
    {       
        $customer = $this->_accountManagement->authenticate($email, $password);

        if($customer->getId())
        {
            $customerSession = $this->_sessionFactory->create();

            // variables nunca se guardan por cache -> ARREGLAR
            $isLoggedIn = $customerSession->isLoggedIn();
            $customerId = $customerSession->getId();
            $this->_logger->info('is logged in: '.$isLoggedIn);
            $this->_logger->info('customer ID: '.$customerId);
            
            if ($isLoggedIn) {
                return "Customer is already logged in";
            }

            $customer = $this->getCustomer($email);
            $customerSession->setCustomerDataAsLoggedIn($customer);
            return $customer;
        } 
        else {
            return "Customer could not login";
        } 
    }

    /**
     * {@inheritdoc}
     * 
     */
    public function logoutContact()
    {
        $customerSession = $this->_sessionFactory->create();
        $customerId = $customerSession->getId();

        if($customerId) 
        {
            $customerSession->logout()->setLastCustomerId($customerId);
            return "Customer logout successfully";
        } else {
            return "Customer is not logged in";
        }
    }
}