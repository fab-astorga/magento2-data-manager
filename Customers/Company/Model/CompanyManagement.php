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
        \Customers\Integration\Api\CustomerInterface $integration,  //cambiar
        \Customers\Contact\Api\CustomerDataRepositoryInterface $customerDataRepository,
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
        $this->_companyCollection                 = $companyCollection;
        $this->_resourceModelCompany              = $resourceModelCompany;
        $this->_companyRepository                 = $companyRepository;
        $this->_contactManagement                 = $contactManagement;
        $this->_logger                            = $logger;
        $this->_integration                       = $integration;
        $this->_customerDataRepository            = $customerDataRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function registerCompanyTest()
    {
        $companyName = "Dos Pinos";
        $username = "2pinos";
        $password = "heladitosricos"; // El password viene de netsuite
        $primaryContact = "Jose Astorga";                                    
        $jobTitle = "my title"; 
        $invoiceEmail = "dospinos@gmail.com"; 
        $businessPhone = "758685588";
        $extension = "+506";            
        $stateSalesTaxLicense = "my dp license";
        $websiteAddress = "https://www.dospinos.com";
        $preferredModeOfDelivery = "ups";                             
        $howDidYouHearAboutUs = "i hear from other people";
        $altPhone = "88779944";
        $fax = "55546658";
        $priceLevel = "";
        $role = "my role";                           
        $additionalInvoiceEmailRecipient = "jastorga@gmail.com";
        $permission = false;
        
        /*$myAddress = array("address"=>"Cartago", "aptSuite"=>"47", 
                                "city"=>"Los Angeles", "state"=>"whatever", "zip"=>"445", 
                                "country"=>"CR", "isDefaultMyAddress"=>1, "isDefaultShipping"=>0, "isDefaultBilling"=>0);*/

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
        
        $addresses = array( /*$myAddress,*/ $shippingAddress, $billingAddress);

        $result = $this->registerCompany(
            $companyName, 
            $username, 
            $password, 
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
    public function registerCompany(
        $companyName, 
        $username, 
        $password, 
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
    )
    {
        $existsInNetsuite = false;
        $contactCredentials = explode(" ", $primaryContact); 

        $storeId = $this->_storeManager->getStore()->getId();
        $websiteId = $this->_storeManager->getStore($storeId)->getWebsiteId();

        /* Store company data in Magento entitites */
        try {

            $customer = $this->_customerInterface->create();
            $customer->setWebsiteId($websiteId);
            $customer->setEmail($invoiceEmail);
            $customer->setFirstname($companyName);
            $customer->setLastname($companyName);
            $hashedPassword = $this->_encryptor->getHash($password, true);

            $this->_customerRepository->save($customer, $hashedPassword);
            $customer = $this->_customerFactory->create();
            $customer->setWebsiteId($websiteId)->loadByEmail($invoiceEmail);

            $this->_customerDataRepository->save(
                $customer->getId(),
                self::COMPANY
            );

            $company = $this->_companyRepository->save(
                            $customer->getId(),
                            null, // netsuite ID
                            $companyName, 
                            $username, 
                            $password,  //deberia venir de netsuite
                            $primaryContact,  //  $contact['name']                             
                            $jobTitle,  // $contact['job_title']
                            $invoiceEmail,   // $contact['email']
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
                            $existsInNetsuite
                    );

            foreach ($addresses as $tmpAddress)
            {
                $address = $this->_addressDataFactory->create();
                // Required values for entity
                $address->setFirstname($companyName);
                $address->setLastname($companyName);
                $address->setTelephone(self::DEFAULT);
                $street[] = self::DEFAULT;
                $address->setStreet($street);
                $address->setCity($tmpAddress['city']);
                $address->setCountryId($tmpAddress['country']);
                $address->setPostcode($tmpAddress['zip']);
                $address->setIsDefaultShipping($tmpAddress['set_is_default_shipping']);
                $address->setIsDefaultBilling($tmpAddress['set_is_default_billing']);
                $address->setCustomerId($customer->getId());
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
            
            /*  Create contact */
            $this->_contactManagement->registerContact(
                $additionalInvoiceEmailRecipient, 
                $contactCredentials[0], //firstname 
                $contactCredentials[1], //lastname
                $password,  // ?????
                null,   // netsuite ID viene en el json desde netsuite: $response['contact']['netsuite_id']
                $customer->getId(),
                $jobTitle, 
                $addresses
            );

            return $company;
        
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
 
    }

    /**
     * {@inheritdoc}
     */
    public function updateCompanyFromNetsuite()
    {
        $data = (array) json_decode(file_get_contents('php://input'), true);

        try {
            $company = $this->_companyRepository->get($data["netsuite_id"], 'netsuite_id');
        } catch (\Exception $e) {
            return false;
        }
        $company->setCompanyName($data["company_name"]);
        $company->setInvoiceEmail($data["email_address"]);
        $company->setBusinessPhone($data["business_phone"]);
        $company->setStateSalesTaxLicense($data["state_sales_tax_license"]);
        $company->setWebsiteAddress($data["website_address"]);
        $company->setPreferredModeOfDelivery($data["preferred_mode_of_delivery"]);
        $company->setAltPhone($data["alt_phone"]);
        $company->setFax($data["fax"]);
        $company->setPriceLevel($data["price_level"]);
        $company->setRole($data["role"]);
        $company->setAdditionalInvoiceEmailRecipient($data["additional_invoice_email_recipient"]);
        $company->setPermission($data["permission"]);

        $this->_resourceModelCompany->save($company);

      /*  foreach ($data["addresses"] as $address)
        {
            try {
                $addressCompany = $this->_addressCompanyRepository->get($address["netsuite_id"], 'netsuite_id');
            } catch (\Exception $e) {
                return false;
            }               
            $addressCompany->setZip($address["zip"]);
            $addressCompany->setCountry($address["country"]);
            $addressCompany->setAddress($address["address"]);
            $addressCompany->setCity($address["city"]);
            $addressCompany->setAptSuite($address["apt_suite"]);
            $addressCompany->setState($address["state"]);
            $addressCompany->setIsDefaultBilling($address["set_is_default_billing"]);
            $addressCompany->setIsDefaultShipping($address["set_is_default_shipping"]);
        }  */

        return $company;
    }

    /**
     * {@inheritdoc}
     * 
     */
    public function getCompany($email)
    {
        $customer = $this->_customerRepository->get($email);
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
    public function deleteCompany($netsuiteId, $contactId)
    {
        /**Delete in netsuite */
        $data = [
            'netsuite_id' => $netsuiteId,
            'contacts'    => array($contactId),
            'delete'      => true
        ];
        $response = $this->_integration->deleteCompanyNetsuite($data);
        $result = json_decode($response, true);

        if (!empty($result['error'])) {
            return $result['error'];
        }
        
        /**Delete in magento */
        $company = $this->_companyRepository->get($netsuiteId, 'netsuite_id');
        $contact = $this->_contactRepository->get($contactId, 'netsuite_id');

        $deleteCompany = $this->_customerRepository->deleteById($company->getCustomerId());
        $deleteContact = $this->_customerRepository->deleteById($contact->getCustomerId());

        return ($deleteCompany && $deleteContact);
    }


    /**
     * {@inheritdoc}
     * 
     */
    public function updateCompany($email, $firstname, $lastname)
    {
        try {
            $company = $this->getContact($email);

            if($company->getId())
            {
                $company->setFirstname($firstname);
                $company->setLastname($lastname);
            }
            $this->_customerRepository->save($company);

            return true;

        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
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
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function loginCompany($email, $password)
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

            $customer = $this->getCompany($email);
            $customerSession->setCustomerDataAsLoggedIn($customer);
            return $customer;
        } 
        else {
            return "Customer could not login";
        } 
    }

    /**
     * {@inheritdoc}
     */
    public function logoutCompany()
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