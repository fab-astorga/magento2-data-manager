<?php

namespace Customer\Manager\Model;

use Exception;
use Customer\Manager\Api\CustomerManagementInterface;

class CustomerManagement implements CustomerManagementInterface 
{
    protected $_storeManager;
    protected $_customerInterface;
    protected $_encryptor;
    protected $_customerRepository;
    protected $_customerFactory;
    protected $_sessionFactory;
    protected $_accountManagement;
    protected $_addressRepository;
    protected $_addressDataFactory;
    protected $_customerExtraAttributesRepository;
    protected $_addressExtraAttributesRepository;
    protected $_addressExtensionFactory;
    protected $_customerCollection;
    protected $_addressExtraAttributesCollection;
    protected $_logger;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Customer\Api\Data\CustomerInterfaceFactory $customerInterface,
        \Magento\Framework\Encryption\EncryptorInterface $encryptor,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Customer\Model\SessionFactory $sessionFactory,
        \Magento\Customer\Api\AccountManagementInterface $accountManagement,
        \Magento\Customer\Api\AddressRepositoryInterface $addressRepository,
        \Magento\Customer\Api\Data\AddressInterfaceFactory $addressDataFactory,
        \Customer\Manager\Api\CustomerExtraAttributesRepositoryInterface $customerExtraAttributesRepository,
        \Customer\Address\Api\AddressExtraAttributesRepositoryInterface $addressExtraAttributesRepository,
        \Magento\Customer\Api\Data\AddressExtensionFactory $addressExtensionFactory,
        \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $customerCollection,
        \Customer\Address\Model\ResourceModel\AddressExtraAttributes\CollectionFactory $addressExtraAttributesCollection,
        \File\CustomLog\Logger\Logger $logger
    ) 
    {
        $this->_storeManager                      = $storeManager;
        $this->_customerInterface                 = $customerInterface;
        $this->_encryptor                         = $encryptor;
        $this->_customerRepository                = $customerRepository;
        $this->_customerFactory                   = $customerFactory;
        $this->_sessionFactory                    = $sessionFactory;
        $this->_accountManagement                 = $accountManagement;
        $this->_addressRepository                 = $addressRepository;
        $this->_addressDataFactory                = $addressDataFactory;
        $this->_customerExtraAttributesRepository = $customerExtraAttributesRepository;
        $this->_addressExtraAttributesRepository  = $addressExtraAttributesRepository;
        $this->_addressExtensionFactory           = $addressExtensionFactory;
        $this->_customerCollection                = $customerCollection;
        $this->_addressExtraAttributesCollection  = $addressExtraAttributesCollection;
        $this->_logger                            = $logger;
    }

    /**
     * {@inheritdoc}
     * 
     */
    public function registerCustomerTest() 
    {
        $email = 'csolano@gmail.com';
        $firstname = 'catalina';
        $lastname = 'solano';
        $password = 'catasp';
        $netsuiteId = 3333; 
        $role = 'admin';
        $jobTitle = 'licenciada';
        $permission = true;
        
        $myAddress = array("countryId"=>"US", "city"=>"Dallas", "zip"=>"55897", 
                                "address"=>"my address", "aptSuite"=>"aparment 27", "state"=>"Colorado", 
                                "setIsDefaultMyAddress"=>1, "setIsDefaultShipping"=>0, "setIsDefaultBilling"=>0);

        $shippingAddress = array("countryId"=>"US", "city"=>"Ozark", "zip"=>"66332",
                                "address"=>"ship address", "aptSuite"=>"aparment 25", "state"=>"Texas", 
                                "setIsDefaultMyAddress"=>0, "setIsDefaultShipping"=>1, "setIsDefaultBilling"=>0);

        $billingAddress = array("countryId"=>"CR", "city"=>"Cartago", "zip"=>"30701",
                                "address"=>"bill address", "aptSuite"=>"aparment 15", "state"=>"Iowa", 
                                 "setIsDefaultMyAddress"=>0, "setIsDefaultShipping"=>0, "setIsDefaultBilling"=>1);

        $addresses = array($myAddress, $shippingAddress, $billingAddress);

        $this->registerCustomer(
            $email, 
            $firstname, 
            $lastname, 
            $password, 
            $netsuiteId, 
            $role, 
            $jobTitle, 
            $permission,
            $addresses
        );
    }

    public function registerCustomer(
        $email, 
        $firstname, 
        $lastname, 
        $password, 
        $netsuiteId, 
        $role, 
        $jobTitle, 
        $permission,
        $addresses
    )
    {
        /* Hacer el request a Netsuite con todos los datos
         Recibir el netsuite id y guardarlo en una variable 
        para luego ejecutar el código de abajo y crear las entidades  */

        $storeId = $this->_storeManager->getStore()->getId();
        $websiteId = $this->_storeManager->getStore($storeId)->getWebsiteId();

        try {
            $customer = $this->_customerInterface->create();
            $customer->setWebsiteId($websiteId);
            $customer->setEmail($email);
            $customer->setFirstname($firstname);
            $customer->setLastname($lastname);
            $hashedPassword = $this->_encryptor->getHash($password, true);

            $this->_customerRepository->save($customer, $hashedPassword);
            $customer = $this->_customerFactory->create();
            $customer->setWebsiteId($websiteId)->loadByEmail($email);

            $this->_customerExtraAttributesRepository->save(
                $customer->getId(), 
                $netsuiteId,
                $role,
                $jobTitle,
                $permission
            );

            foreach ($addresses as $tmpAddress)
            {
                $address = $this->_addressDataFactory->create();
                // Required values for entity
                $address->setFirstname($firstname);
                $address->setLastname($lastname);
                $address->setTelephone('default');
                $street[] = 'default street';
                $address->setStreet($street);
                $address->setCity($tmpAddress['city']);
                $address->setCountryId($tmpAddress['countryId']);
                $address->setPostcode($tmpAddress['zip']);
                $address->setIsDefaultShipping($tmpAddress['setIsDefaultShipping']);
                $address->setIsDefaultBilling($tmpAddress['setIsDefaultBilling']);
                $address->setCustomerId($customer->getId());
                $this->_addressRepository->save($address);
                
               $addressExtraAttributes = $this->_addressExtraAttributesRepository->save(
                                            $address->getId(),
                                            $tmpAddress['address'],
                                            $tmpAddress['aptSuite'],
                                            $tmpAddress['state'],
                                            $tmpAddress['setIsDefaultMyAddress']
                                        ); 
            }
            
            return true;

        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * {@inheritdoc}
     * 
     */
    public function getCustomer($email)
    {
        return $this->_customerRepository->get($email);
    }

    /**
     * {@inheritdoc}
     */
    public function getAllCustomers()
    {
        $collection = $this->_customerCollection->create();
        $customers = array();

        foreach ($collection as $item)
        {
            $customer = $this->getCustomer($item->getEmail());
            $customers[] = $customer;

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
        }

        return $customers;
    }

    /**
     * {@inheritdoc}
     * 
     */
    public function deleteCustomer($email)
    {
        try {
            $customer = $this->_customerRepository->get($email);
            $this->_customerRepository->delete($customer);
            return true;

        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * {@inheritdoc}
     * 
     */
    public function updateCustomer($email, $firstname, $lastname)
    {
        try {
            $customer = $this->getCustomer($email);

            if($customer->getId())
            {
                $customer->setFirstname($firstname);
                $customer->setLastname($lastname);
            }
            $this->_customerRepository->save($customer);

            return true;

        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * {@inheritdoc}
     * 
     */
    public function changePasswordCustomer($email, $actualPassword, $newPassword)
    {
        try {
            $customer = $this->getCustomer($email);

            if($customer->getId())  {
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
    public function loginCustomer($email, $password)
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
    public function logoutCustomer()
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