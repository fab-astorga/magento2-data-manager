<?php

namespace Customers\Company\Model;

use Exception;
use Customers\Company\Api\CompanyManagementInterface;

class CompanyManagement implements CompanyManagementInterface
{
    const DEFAULT = 'default';
    const COMPANY = 'company';

    protected $_storeManager;
    protected $_customerInterface;
    protected $_encryptor;
    protected $_customerRepository;
    protected $_customerExtensionFactory;
    protected $_customerFactory;
    protected $_sessionFactory;
    protected $_accountManagement;
    protected $_addressRepository;
    protected $_addressDataFactory;
    protected $_contactRepository;
    protected $_addressDataRepository;
    protected $_addressExtensionFactory;
    protected $_customerCollection;
    protected $_addressDataCollection;
    protected $_companyCollection;
    protected $_contactManagement;
    protected $_companyRepository;
    protected $_resourceModelCompany;
    protected $_logger;
    protected $_integration;
    protected $_customerDataRepository;
    protected $_passwordGenerator;
    protected $_emailCourier;
    protected $_resourceModelAddressData;
    protected $_resourceModelContact;
    protected $_customerSession;
    protected $_redirect;
    protected $_emailManager;
    protected $_wishlistManagement;
    protected $_companyData;


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
        \Customers\Company\Model\ResourceModel\Company\CollectionFactory $companyCollection,
        \Customers\Company\Api\CompanyRepositoryInterface $companyRepository,
        \Customers\Company\Model\ResourceModel\Company $resourceModelCompany,
        \Customers\Contact\Api\ContactManagementInterface $contactManagement,
        \Customers\Wishlist\Api\WishlistManagementInterface $wishlistManagement,
        \Customers\Contact\Api\CustomerDataRepositoryInterface $customerDataRepository,
        \Customers\Company\Helper\PasswordGenerator $passwordGenerator,
        //\Integration\Management\Api\IntegrationInterface $integration,
        //\Customers\Company\Helper\Email $emailCourier,
        \Customers\Address\Model\ResourceModel\AddressData $resourceModelAddressData,
        \Customers\Contact\Model\ResourceModel\Contact $resourceModelContact,
        \File\CustomLog\Logger\Logger $logger,
        \Customers\Company\Helper\Email $emailManager,
        \Magento\Framework\App\Action\Context $context,
        \Magento\Customer\Model\Session $customerSession
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
        $this->_companyCollection                 = $companyCollection;
        $this->_resourceModelCompany              = $resourceModelCompany;
        $this->_companyRepository                 = $companyRepository;
        $this->_contactManagement                 = $contactManagement;
        $this->_logger                            = $logger;
        $this->_wishlistManagement                = $wishlistManagement;
        $this->_customerDataRepository            = $customerDataRepository;
        $this->_passwordGenerator                 = $passwordGenerator;
        //$this->_emailCourier                      = $emailCourier;
        $this->_resourceModelAddressData          = $resourceModelAddressData;
        $this->_resourceModelContact              = $resourceModelContact;
        $this->_emailManager                      = $emailManager;    
        $this->_customerSession                   = $customerSession;
        //$this->_integration                       = $integration;
        $this->_redirect                          = $context->getRedirect();
    }

    /**
     * {@inheritdoc}
     */
    public function registerCompanyTest()
    {
        $companyName = "Midware";
        $username = "midwr";
        $primaryContact = "Pablo Vela";                                    
        $jobTitle = "CEO"; 
        $invoiceEmail = "pablovela@gmail.com"; 
        $businessPhone = "88546993";
        $extension = "+506";            
        $stateSalesTaxLicense = "MIDWR license";
        $websiteAddress = "https://www.midware.net";
        $preferredModeOfDelivery = "ups";                             
        $howDidYouHearAboutUs = "i hear from other customers";
        $altPhone = "84333333";
        $fax = "2223365";
        $priceLevel = "";
        $role = "developer";                           
        $additionalInvoiceEmailRecipient = "fabianastorga@gmail.com";
        $permission = false;

        $myAddress = array(
            "zip"=>33101, 
            "country"=>"US",
            "address"=>"Near to Ozarks lake", 
            "city"=>"Utah", 
            "apt_suite"=>"43",                                
            "state"=>"cant remember",                               
            "set_is_default_my_address"=>true,
            "set_is_default_billing"=>false, 
            "set_is_default_shipping"=>false
        );                        

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
        
        $addresses = array($myAddress, $shippingAddress, $billingAddress);

        $result = $this->sendFormData(
            $companyName, 
            $username, 
            $primaryContact,                                    
            $jobTitle, 
            $invoiceEmail, 
            $businessPhone, 
            $extension,            
            $stateSalesTaxLicense, 
            $websiteAddress, 
            $preferredModeOfDelivery,                             
            $howDidYouHearAboutUs, 
            $altPhone, 
            $fax, 
            $priceLevel, 
            $role,                            
            $additionalInvoiceEmailRecipient, 
            $permission, 
            $addresses
        );

        return $result;
    }

    
    /**
     * {@inheritdoc}
     */
    public function sendFormData (
        $companyName, 
        $username,  
        $primaryContact,                                    
        $jobTitle, 
        $invoiceEmail, 
        $businessPhone, 
        $extension,       
        $stateSalesTaxLicense, 
        $websiteAddress, 
        $preferredModeOfDelivery,                             
        $natureOfBusiness, 
        $altPhone, 
        $fax, 
        $priceLevel, 
        $role,                        
        $additionalInvoiceEmailRecipient, 
        $permission, 
        $addresses
    )
    {
        /** store data till Netsuit approved the registration */
        $this->_companyData = [
            'user_name'             => $username,
            'primary_contact'       => $primaryContact,
            'job_title'             => $jobTitle,
            'extension'             => $extension,
            'nature_of_business'    => $natureOfBusiness,
            'role'                  => $role
        ];

        /** SEND DATA TO GS */
        $emailData = [
            'company_name'                       => $companyName,
            'email_address'                      => $invoiceEmail,
            'business_phone'                     => $businessPhone,
            'state_sales_tax_license'            => $stateSalesTaxLicense,
            'preferred_mode_of_delivery'         => $preferredModeOfDelivery,
            'website_address'                    => $websiteAddress,
            'alt_phone'                          => $altPhone,
            'fax'                                => $fax,
            'price_level'                        => $priceLevel,
            'permission'                         => $permission,
            'additional_invoice_email_recipient' => $additionalInvoiceEmailRecipient,
            'addresses'                          => $addresses
        ];     
        /**send email to GS */
        $this->_emailManager->sendGSEmail($emailData);

        
    }

    /**
     * {@inheritdoc}
     */
    public function saveCompanyNetsuite(){
        $data = (array) json_decode(file_get_contents('php://input'), true);

        $result = [];
        try{
            $storeId = $this->_storeManager->getStore()->getId();
            $websiteId = $this->_storeManager->getStore($storeId)->getWebsiteId();
            /* Create customer */
            $customer = $this->_customerInterface->create();
            $customer->setWebsiteId($websiteId);
            $customer->setEmail($data["email_address"]);
            $customer->setFirstname($data['company_name']);
            $customer->setLastname($data['company_name']);

            /* Customer company Password is generated automatically */
            $password = $this->_passwordGenerator->generatePassword();
            $this->_logger->info('password generated: ' . $password );
            $hashedPassword = $this->_encryptor->getHash($password, true);

            $this->_customerRepository->save($customer, $hashedPassword);

            $companyCustomer = $this->_customerFactory->create();
            $companyCustomer->setWebsiteId($websiteId)->loadByEmail($data["email_address"]);
            $company = $this->_companyRepository->save(
                            $companyCustomer->getId(),
                            $data['netsuite_id'],
                            $data['company_name'],                       
                            $data["email_address"],
                            $data['business_phone'],          
                            $data['state_sales_tax_license'], 
                            $data['website_address'], 
                            $data['preferred_mode_of_delivery'],                           
                            $data['alt_phone'], 
                            $data['fax'], 
                            $data['price_level'],                          
                            $data['additional_invoice_email_recipient'], 
                            $data['access']
            );

             /* Create customer addresses */
            foreach ($data['addresses'] as $tmpAddress)
            {
                 $address = $this->_addressDataFactory->create();
                 // Required values for entity
                 $address->setFirstname($data['company_name']);
                 $address->setLastname($data['company_name']);
                 $address->setTelephone(self::DEFAULT);
                 $street[] = self::DEFAULT;
                 $address->setStreet($street);
                 $address->setCity($tmpAddress['city']);
                 $address->setCountryId($tmpAddress['country']);
                 $address->setPostcode($tmpAddress['zip']);
                 $address->setIsDefaultShipping($tmpAddress['set_is_default_shipping']);
                 $address->setIsDefaultBilling($tmpAddress['set_is_default_billing']);
                 $address->setCustomerId($companyCustomer->getId());
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

             /* Store customer type */
            $this->_customerDataRepository->save(
                $companyCustomer->getId(),
                self::COMPANY
            );
             
             // Send password by email and change permission flag !!!!

            $emailData = [
                'user_name'         => $data['company_name'],
                'user_password'     => $password
            ];
            $this->_emailManager->sendPasswordEmail($emailData,$customer->getEmail());
            //change permission
            $company->setAccess( true );
            
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
    public function updateCompanyNetsuite()
    {
        $data = (array) json_decode(file_get_contents('php://input'), true);
        $result = [];
        /* Retrieves customer entity with Netsuite info */
        try {
            $customer = $this->_customerRepository->get($data["email_address"]);

                /* Update company data */
            $company = $this->_companyRepository->get($customer->getId(), 'customer_id');

            $company->setNetsuiteId( $data['netsuite_id'] );
            $company->setCompanyName( $data['company_name'] );
            $company->setInvoiceEmail( $data['email_address'] );
            $company->setBusinessPhone( $data['business_phone'] );
            $company->setStateSalesTaxLicense( $data['state_sales_tax_license'] );
            $company->setWebsiteAddress( $data['website_address'] );
            $company->setPreferredModeOfDelivery( $data['preferred_mode_of_delivery'] );
            $company->setAltPhone( $data['alt_phone'] );
            $company->setFax( $data['fax'] );
            $company->setPriceLevel( $data['price_level'] );
            $company->setAdditionalInvoiceEmailRecipient( $data['additional_invoice_email_recipient'] );
            $company->setAccess( $data['access'] );
            $this->_resourceModelCompany->save($company);

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

        } catch (\Exception $e) {
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
    public function getCompany($value)
    {
        $customer = $this->_customerRepository->get($value);
        return $customer;
    }


    /**
     * {@inheritdoc}
     * 
     */
    public function getAllCompanies()
    {
        $collection = $this->_customerCollection->create();

        $companies = array();

        foreach ($collection as $item)
        {
            $company = $this->getCompany($item->getEmail());
            if (!is_string($company)) {
                $companies[] = $company;
            }  
        }

        return $companies;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteCompany()
    {
        $data = (array) json_decode(file_get_contents('php://input'), true);
        $result = [];
        /* Retrieves customer entity with Netsuite info */
        try {
            //verify the company exist
            $customer = $this->_customerRepository->get($data["email_address"]);

            //get all the contacts
            $contacts = $this->_contactRepository->getCollection();

            foreach ($contacts as $contact){
                //delete company contacts
                if ( $contact->getCompanyId() == $customer->getId()){
                    $customerContact = $this->_customerRepository->get($contact->getEmail());
                    $this->_customerRepository->delete($customerContact);
                }
            }
            //delete company
            $this->_customerRepository->delete($customer);

            $result = [
                "status"=>true,
                "error"=>null
             ];

        } catch (\Exception $e) {
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
    public function updateCompany($email,
                                $firstname,
                                $lastname,
                                $companyName,
                                $businessPhone,
                                $address,
                                $zipcode,
                                $country,
                                $state,
                                $city
                                )
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
                $company = $this->_companyRepository->get($customer->getId(), 'customer_id');


                $company->setCompanyName( $data['company_name'] );
                $company->setBusinessPhone( $data['business_phone'] );
                $this->_resourceModelCompany->save($company);

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

                $company = $this->getCompany($email);

                if($company->getId())
                {
                    $company->setFirstname($firstname);
                    $company->setLastname($lastname);
                }
                $this->_customerRepository->save($company);
    
                return true;
            //}

            
        }catch (Exception $exception) {
            return false;
        }
    }

    /**
     * {@inheritdoc}
     * 
     */
    public function changePasswordCompany($email, $actualPassword, $newPassword)
    {
        try {
            $company = $this->getCompany($email);

            if($company->getId())  {
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
     */
    public function loginCompany($email, $password)
    {
        $customer = $this->_customerRepository->get($email);
        $validate = $this->_accountManagement->authenticate($email, $password);

        if ($validate->getId()){

            if ($this->_customerSession->getMyValue() != -1){
                return "Customer is already logged in";
            }
            else{
                    $sessionManager = $this->_sessionFactory->create();
                    $customer = $this->_customerFactory->create()->load($validate->getId()); //$id is the customer id you want to load
                    
                    $company = $this->_companyRepository->get($customer->getEmail(), 'invoice_email');

                    if ($company->getAccess())
                    {
                        $sessionManager->setCustomerAsLoggedIn($customer);
                        $this->_customerSession->setMyValue($validate->getId());
                        return "Customer login successfully";
                    }else{
                        return "Customer don't have permissions to access";
                    } 
                }

            }
            else{
                return "Customer could not login";
            }

        
        }

    /**
     * {@inheritdoc}
     */
    public function logoutCompany()
    {
        $customerId = $this->_customerSession->getMyValue();
        if( $customerId != -1) 
        {
            $this->_customerSession->logout()->setBeforeAuthUrl($this->_redirect->getRefererUrl())
            ->setLastCustomerId($customerId);
            $this->_customerSession->setMyValue(-1);
            return "Customer logout successfully";
        } else {
            return "Customer is not logged in";
        }
    }
}