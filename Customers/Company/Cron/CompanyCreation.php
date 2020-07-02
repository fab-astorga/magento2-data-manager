<?php

namespace Customers\Company\Cron;

class CompanyCreation 
{
    protected $_companyRepository;
    protected $_companyManagement;
    protected $_filterBuilder;
    protected $_searchCriteriaBuilder;
    protected $_addressDataRepository;
    protected $_resourceModelAddressData;
    protected $_resourceModelCompany;
    protected $_integration;
    protected $_contactRepository;
    protected $_resourceModelContact;
    protected $_customerRepository; 

    protected $_logger;

    public function __construct(
        \Customers\Company\Api\CompanyRepositoryInterface $companyRepository,
        \Customers\Company\Api\CompanyManagementInterface $companyManagement,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        \Customers\Address\Api\AddressDataRepositoryInterface $addressDataRepository,
        \Customers\Address\Model\ResourceModel\AddressData $resourceModelAddressData,
        \Customers\Company\Model\ResourceModel\Company  $resourceModelCompany,
        \Customers\Contact\Api\ContactRepositoryInterface $contactRepository,
        \Customers\Contact\Model\ResourceModel\Contact  $resourceModelContact,
        \Customers\Integration\Api\CustomerInterface $integration,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \File\CustomLog\Logger\Logger $logger
    ) 
    {
        $this->_companyRepository            = $companyRepository;
        $this->_companyManagement            = $companyManagement;
        $this->_searchCriteriaBuilder        = $searchCriteriaBuilder;
        $this->_filterBuilder                = $filterBuilder;
        $this->_addressDataRepository        = $addressDataRepository;
        $this->_resourceModelAddressData     = $resourceModelAddressData;
        $this->_resourceModelCompany         = $resourceModelCompany;
        $this->_contactRepository            = $contactRepository;
        $this->_resourceModelContact         = $resourceModelContact;
        $this->_integration                  = $integration;
        $this->_logger                       = $logger;
        $this->_customerRepository           = $customerRepository;
    }

   public function execute()
   {
        $this->_logger->info('--------------STARTING CRON ----------------');

        /** Get all customers which are not registered in Netsuite yet */
        $filterCustomer[] = $this->_filterBuilder
                        ->setField('exists_in_netsuite')
                        ->setValue(false)
                        ->setConditionType('eq')
                        ->create();
            
        $searchCriteriaCustomer = $this->_searchCriteriaBuilder->addFilters($filterCustomer);
        $searchResultsCustomer = $this->_companyRepository->getList($searchCriteriaCustomer->create());
        $customerCompanies = $searchResultsCustomer->getItems();

        foreach ($customerCompanies as $company)
        {
            $this->_logger->info('Registering companies in netsuite...');

            try {
                $customer = $this->_customerRepository->getById($company->getCustomerId());

            } catch (\Exception $exception) {
                $this->_logger->info('An exception has ocurred: '.$exception->getMessage());
            }

            $addresses = array();

            foreach ($customer->getAddresses() as $address)
            {
                $addressData = $this->_addressDataRepository->get($address->getId(), 'address_id');

                $customerAddress = array(
                    "zip"                     => $address->getPostcode(), 
                    "country"                 => $address->getCountryId(),
                    "address"                 => $addressData->getAddress(),
                    "city"                    => $address->getCity(),
                    "apt_suite"               => $addressData->getAptSuite(),                                
                    "state"                   => $addressData->getState(),                               
                    "set_is_default_billing"  => (boolean) $address->isDefaultBilling(),
                    "set_is_default_shipping" => (boolean) $address->isDefaultShipping()
                );
                $addresses[] = $customerAddress;            
            }  
            
            $data = [
                        'company_name'                       => $company->getCompanyName(),
                        'primary_contact'                    => $company->getPrimaryContact(),
                        'email_address'                      => $company->getInvoiceEmail(),
                        'business_phone'                     => $company->getBusinessPhone(),
                        'state_sales_tax_license'            => $company->getStateSalesTaxLicense(),
                        'website_address'                    => $company->getWebsiteAddress(),
                        'preferred_mode_of_delivery'         => $company->getPreferredModeOfDelivery(),
                        'alt_phone'                          => $company->getAltPhone(),
                        'fax'                                => $company->getFax(),
                        'price_level'                        => $company->getPriceLevel(),
                        'additional_invoice_email_recipient' => $company->getAdditionalInvoiceEmailRecipient(),
                        'permission'                         => (boolean) $company->getPermission(),
                        'job_title'                          => $company->getJobTitle(),
                        'addresses'                          => $addresses
                    ];     

            /* Send request to Netsuite in order to save company record */
            try {
                $response = $this->_integration->postCompanyRegistration($data);
            } catch (\Exception $e) {
                $this->_logger->info('error message: '. $e->getMessage());
                $company->setExistsInNetsuite(false);
                break;
            }

            $this->_logger->info('netsuite response: ' . $response);
    
            $result = json_decode($response, true);
            $customerInNetsuite = (empty($result["error"])) ? true : false;
            $this->_logger->info('netsuite id company: ' . $result["netsuite_id"]);

            $index = 0;

            /* Set netsuite ID to company addresses */
            foreach ($customer->getAddresses() as $addr)
            {
                $addressData = $this->_addressDataRepository->get(
                                    $addr->getId(),
                                    'address_id'
                                );
                $addressData->setNetsuiteId( $result["addresses"][$index]["netsuite_id"] );
                $this->_logger->info('netsuite id address: ' . $result["addresses"][$index]["netsuite_id"]);
                $this->_resourceModelAddressData->save($addressData);
                $index++;
            }

            /* Store company netsuite ID */
            $company->setNetsuiteId($result["netsuite_id"]);
            $company->setExistsInNetsuite($customerInNetsuite);
            $this->_resourceModelCompany->save($company);

            /* Store contact netsuite ID */
            $contact = $this->_contactRepository->get(
                $company->getCustomerId(), 
                'company_id'
            );
            $contact->setNetsuiteId($result["contact"]["netsuite_id"]);
            $this->_logger->info('netsuite id contact: ' . $result["contact"]["netsuite_id"]);
            $this->_resourceModelContact->save($contact); 
        }

       $this->_logger->info('--------------FINISHING CRON----------------');
       return $this;
   }
}