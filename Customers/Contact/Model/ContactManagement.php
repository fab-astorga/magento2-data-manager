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
    protected $_passwordGenerator;
    protected $_emailManager;
    protected $_integration;
    protected $_resourceModelAddressData;
    protected $_resourceModelContact;
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
        \Customers\Contact\Model\ResourceModel\Contact $resourceModelContact,
        \Customers\Company\Helper\PasswordGenerator $passwordGenerator,
        //\Integration\Management\Api\IntegrationInterface $integration,
        \Customers\Address\Model\ResourceModel\AddressData $resourceModelAddressData,
        \Customers\Address\Api\AddressDataRepositoryInterface $addressDataRepository,
        \Customers\Address\Model\ResourceModel\AddressData\CollectionFactory $addressDataCollection,
        \Customers\Contact\Api\CustomerDataRepositoryInterface $customerDataRepository,
        \Customers\Company\Helper\Email $emailManager,
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
        $this->_resourceModelContact              = $resourceModelContact;
        $this->_addressDataRepository             = $addressDataRepository;
        $this->_addressDataCollection             = $addressDataCollection;
        $this->_customerDataRepository            = $customerDataRepository;
        $this->_resourceModelAddressData          = $resourceModelAddressData;
        $this->_passwordGenerator                 = $passwordGenerator;
        $this->_emailManager                      = $emailManager;
        //$this->_integration                       = $integration; 
     //   $this->_companyRepository                 = $companyRepository;
        $this->_logger                            = $logger;
    }

    /**
     * {@inheritdoc}
     * 
     */
    public function registerContactTest() 
    {
        $email = 'jeanvega0797@gmail.com';
        $firstname = 'Jean Vega';
        $password = 'jvega';
        $netsuiteId = 3;
        $companyId = 51;
        $jobTitle = 'Designer';
        $phone = "74843692";
        $shippingAddress = array(
            "zip"=>33101, 
            "country"=>"US",
            "address"=>"California", 
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
            "address"=>"Vancouver", 
            "city"=>"Whitecaps", 
            "apt_suite"=>"7",                                
            "state"=>"whatever",                               
            "set_is_default_my_address"=>false,
            "set_is_default_billing"=>false, 
            "set_is_default_shipping"=>true
        );

        $addresses = array($shippingAddress, $billingAddress);

        $access = false;
        $isRegistered = $this->registerContact(
                $email, 
                $firstname, 
                $netsuiteId, 
                $companyId,
                $jobTitle, 
                $phone,
                $addresses,
                $access
            );

        return $isRegistered;
    }

    public function registerContact()
    {

        $data = (array) json_decode(file_get_contents('php://input'), true);
        
        $result = [];
        /* Hacer el request a Netsuite con todos los datos
         Recibir el netsuite id y guardarlo en una variable 
        para luego ejecutar el código de abajo y crear las entidades */

        try {



                $storeId = $this->_storeManager->getStore()->getId();
                $websiteId = $this->_storeManager->getStore($storeId)->getWebsiteId();

                $contactCredentials = explode(" ", $data["name"]);
                $customer = $this->_customerInterface->create();
                $customer->setWebsiteId($websiteId);
                $customer->setEmail($data["email_address"]);
                $customer->setFirstname($contactCredentials[0]);
                $customer->setLastname($contactCredentials[1]);

                
                $password = $this->_passwordGenerator->generatePassword();
                /* Customer contact Password is generated automatically */
                $hashedPassword = $this->_encryptor->getHash($password, true);

                

               $this->_customerRepository->save($customer, $hashedPassword);

                $contactCustomer = $this->_customerFactory->create();
                $contactCustomer->setWebsiteId($websiteId)->loadByEmail($data["email_address"]);
                $contact = $this->_contactRepository->save(
                    $data["email_address"],
                    $data["netsuite_id"],
                    $contactCustomer->getId(),
                    $data["company_id"],
                    $data["job_title"],
                    $data["phone"],
                    $data["access"]
                );
                foreach ($data["addresses"] as $tmpAddress)
                {
                    $address = $this->_addressDataFactory->create();
                    // Required values for entity
                    $address->setFirstname($contactCredentials[0]);
                    $address->setLastname($contactCredentials[1]);
                    $address->setTelephone(self::DEFAULT);
                    $street[] = self::DEFAULT;
                    $address->setStreet($street);
                    $address->setCity($tmpAddress['city']);
                    $address->setCountryId($tmpAddress['country']);
                    $address->setPostcode($tmpAddress['zip']);
                    $address->setIsDefaultShipping($tmpAddress['set_is_default_shipping']);
                    $address->setIsDefaultBilling($tmpAddress['set_is_default_billing']);
                    $address->setCustomerId($contactCustomer->getId());
                    $this->_addressRepository->save($address);
                    
                    $addressData = $this->_addressDataRepository->save(
                                                $address->getId(),
                                                null,
                                                $tmpAddress['address'],
                                                $tmpAddress['apt_suite'],
                                                $tmpAddress['state'],
                                                false   
                                            ); 
                }
                $this->_customerDataRepository->save(
                    $contactCustomer->getId(),
                    self::CONTACT
                );
             
                // Send password by email and change permission flag !!!!

                $emailData = [
                    'user_name'         => $data['name'],
                    'user_password'     => $password
                ];
                $this->_emailManager->sendPasswordEmail($emailData,$contact->getEmail());
                //change permission
                $contact->setAccess( true );

                $result = [
                    "status"=>true,
                    "error"=>null
                ];

        } catch (Exception $exception) {
            $result = [
                "status"=>false,
                "error"=>$exception->getMessage()
             ];
        }

        $response = json_encode($result);
        return $response;
    }


    /**
     * {@inheritdoc}
     */
    public function updateContactNetsuite(){
        $data = (array) json_decode(file_get_contents('php://input'), true);
        $result = [];

        try{

            $customer = $this->_customerRepository->get($data["email_address"]);

            $contact = $this->_contactRepository->get($customer->getId(), 'customer_id');

            $contact->setEmail($data["email_address"]);
            $contact->setCustomerId($customer->getId());
            $contact->setNetsuiteId($data["netsuite_id"]);
            $contact->setCompanyId($data["company_id"]);
            $contact->setJobTitle($data["job_title"]);
            $contact->setPhone($data["phone"]);
            $contact->setAccess($data["access"]);
            $this->_resourceModelContact->save($contact);
            /* Update customer addresses with netsuite info */        
            $index = 0;
            $addressesToChange = count($data["addresses"]);

            foreach ($customer->getAddresses() as $addr)
            {
                $addressData = $this->_addressDataRepository->get($addr->getId(),'address_id');

                $addressData->setNetsuiteId( $data["addresses"][$index]["netsuite_id"] );
                $addressData->setAddress( $data["addresses"][$index]["address"] );
                $addressData->setAptSuite( $data["addresses"][$index]["apt_suite"] );
                $addressData->setState( $data["addresses"][$index]["state"] );
                $this->_resourceModelAddressData->save($addressData);

                $addr->setCity( $data["addresses"][$index]["city"] );
                $addr->setCountryId( $data["addresses"][$index]["country"] );
                $addr->setPostcode( $data["addresses"][$index]["zip"] );
                $addr->setIsDefaultShipping( $data["addresses"][$index]["set_is_default_shipping"] );
                $addr->setIsDefaultBilling( $data["addresses"][$index]["set_is_default_billing"] );
                $this->_addressRepository->save($addr);
                $index++;

                if ($addressesToChange == $index) {
                    break;
                }
            }

            $result = [
                "status"=>true,
                "error"=>null
             ];

        }catch (Exception $exception) {
            $result = [
                "status"=>false,
                "error"=>$exception->getMessage()
             ];
        }

        $response = json_encode($result);
        return $response;
    }

    /**
     * {@inheritdoc}
     * 
     */
    public function getContact($value)
    {
        $customer = $this->_customerRepository->get($value);
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

            var_dump($item->getId());

            $contact = $this->getContact($item->getEmail());
            if (!is_string($contact)) {
                $contacts [] = $contact;
            }
        }

        return $contacts;
    }

    /**
     * {@inheritdoc}
     * 
     */
    public function deleteContact()
    {
        $data = (array) json_decode(file_get_contents('php://input'), true);
        $result = [];
        try {
            $contact = $this->_customerRepository->get($email);
            $this->_customerRepository->delete($contact);
            $result = [
                "status"=>true,
                "error"=>null
             ];
        } catch (Exception $exception) {
            $result = [
                "status"=>false,
                "error"=>$e->getMessage()
             ];
        }

        $response = json_encode($result);
        return $response;
    }

    /**
     * {@inheritdoc}
     * 
     */
    public function updateContact($email,
                                $firstname,
                                $lastname,
                                $companyName,
                                $businessPhone,
                                $address,
                                $zipcode,
                                $country,
                                $state,
                                $city)
    {
        $addressData = [
            'country'                   => $country,
            'postcode'                  => $zipcode,
            'city'                      => $city,
            'state'                     => $state,
            'address'                   => $address,
            'set_is_default_billing'    => true
        ];
        $data = [
            'company_name'          => $companyName,
            'email_address'         => $email,
            'business_phone'        => $businessPhone,
            'addresses'             => $addressData

        ];     

        try {
            /* Send request to Netsuite in order to make a registration */
            //$response = $this->_integration->sendNetsuiteRequest($data,'POST');

            //$result = json_decode($response, true);

            //if (empty($result["error"])){
            
            $customer = $this->_customerRepository->get($data["email_address"]);
            $customer->setFirstname($firstname);
            $customer->setLastname($lastname);

            /* Update company data */
            $contact = $this->_contactRepository->get($customer->getId(), 'customer_id');

            $contact->setPhone( $data['business_phone'] );
            $this->_resourceModelContact->save($contact);

             /* Update customer addresses with netsuite info */        
             $index = 0;
             $addressesToChange = count($data["addresses"]);
             foreach ($customer->getAddresses() as $addr)
             {
                 if ($addr->getIsDefaultBilling()){
                     $addressData = $this->_addressDataRepository->get($addr->getId(),'address_id');
                     $addressData->setAddress( $data["addresses"][$index]["address"] );
                     $addressData->setState( $data["addresses"][$index]["state"] );

                     $addr->setCity( $data["addresses"][$index]["city"] );
                     $addr->setCountryId( $data["addresses"][$index]["country"] );
                     $addr->setPostcode( $data["addresses"][$index]["zip"] );

                     $this->_addressRepository->save($addr);
                     $index++;

                     if ($addressesToChange == $index) {
                         break;
                     }
                 }
             }

            $contact = $this->getContact($email);

            if($contact->getId())
            {
                $contact->setFirstname($firstname);
                $contact->setLastname($lastname);
            }
            $this->_customerRepository->save($contact);

            return true;
            //}
        } catch (Exception $exception) {

            return false;
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
            return false;
        }
    }

    /**
     * {@inheritdoc}
     * 
     */
    public function loginContact($email, $password)
    {       
        $validate = $this->_accountManagement->authenticate($email, $password);

        if($validate->getId())
        {
            if ($this->_customerSession->getMyValue() != -1){
                return "Customer is already logged in";
            }
            else{
                $customerSession = $this->_sessionFactory->create();
                $customer = $this->_customerFactory->create()->load($validate->getId()); //$id is the customer id you want to load

                $contact =  $this->_contactRepository->get($customer->getEmail(), 'email');

                if ($contact->getAccess())
                {
                    $sessionManager->setCustomerAsLoggedIn($customer);
                    $this->_customerSession->setMyValue($validate->getId());
                    return "Customer login successfully";
                }else{
                    return "Customer don't have permissions to access";
                } 
            }
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