<?php

namespace Customer\Company\Model;

use Exception;
use Customer\Company\Api\CustomerCompanyManagementInterface;

class CustomerCompanyManagement implements CustomerCompanyManagementInterface 
{
    protected $_customerCompanyCollection;
    protected $_customerManagement;
    protected $_customerCompanyRepository;
    protected $_addressCompanyRepository;

    public function __construct(
        \Customer\Company\Model\ResourceModel\CustomerCompany\CollectionFactory $customerCompanyCollection,
        \Customer\Company\Api\CustomerCompanyRepositoryInterface $customerCompanyRepository,
        \Customer\Manager\Api\CustomerManagementInterface $customerManagement,
        \Customer\Company\Api\AddressCompanyRepositoryInterface $addressCompanyRepository
    ) 
    {
        $this->_customerCompanyCollection = $customerCompanyCollection;
        $this->_customerManagement        = $customerManagement;
        $this->_customerCompanyRepository = $customerCompanyRepository;
        $this->_addressCompanyRepository  = $addressCompanyRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function registerCompanyTest()
    {
        $netsuiteId = 3333;
        $companyName = "Pipasa";
        $priceLevel = "pipasa price";
        $invoiceEmail = "pipasa@gmail.com";
        $phone = "87442316";
        $altPhone = "22228899";
        $fax = "45-46-415";
        $additionalInvoiceEmailRecipient = "invoicepipasa";
        
        $myAddress = array("address"=>"Cartago", "aptSuite"=>"47", 
                                "city"=>"Los Angeles", "state"=>"whatever", "zip"=>"445", 
                                "country"=>"CR", "isDefaultMyAddress"=>1, "isDefaultShipping"=>0, "isDefaultBilling"=>0);

        $shippingAddress = array("address"=>"Heredia", "aptSuite"=>"4",
                                "city"=>"San Pablo", "state"=>"whatever", "zip"=>"445", 
                                "country"=>"CR", "isDefaultMyAddress"=>0, "isDefaultShipping"=>1, "isDefaultBilling"=>0);

        $billingAddress = array("address"=>"SJ", "aptSuite"=>"7",
                                "city"=>"Barrio Amon", "state"=>"whatever", "zip"=>"445", 
                                 "country"=>"CR", "isDefaultMyAddress"=>0, "isDefaultShipping"=>0, "isDefaultBilling"=>1);
        
        $addresses = array($myAddress, $shippingAddress, $billingAddress);

        $this->registerCompany(
            $netsuiteId,
            $companyName,
            $priceLevel,
            $invoiceEmail,
            $phone,
            $altPhone,
            $fax,
            $additionalInvoiceEmailRecipient,
            $addresses
        );
    }

    /**
     * {@inheritdoc}
     */
    public function registerCompany(
        $netsuiteId, 
        $companyName, 
        $priceLevel, 
        $invoiceEmail, 
        $phone,
        $altPhone, 
        $fax, 
        $additionalInvoiceEmailRecipient, 
        $addresses
    )
    {
        /* Hacer el request a Netsuite con todos los datos
         Recibir el netsuite id y guardarlo en una variable 
        para luego ejecutar el código de abajo y crear las entidades */

        try {

            $this->_customerCompanyRepository->save(
                    $netsuiteId,
                    $companyName,
                    $priceLevel,
                    $invoiceEmail,
                    $phone,
                    $altPhone,
                    $fax,
                    $additionalInvoiceEmailRecipient
            );

            foreach ($addresses as $address)
            {
                $this->_addressCompanyRepository->save(
                    $netsuiteId,
                    $address['address'],
                    $address['aptSuite'],
                    $address['city'],
                    $address['state'],
                    $address['zip'],
                    $address['country'],
                    $address['isDefaultMyAddress'],
                    $address['isDefaultShipping'],
                    $address['isDefaultBilling']
                );
            }

            return true;
        
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }

    }

    /**
     * {@inheritdoc}
     */
    public function getAllCompanies()
    {
        $collection = $this->_customerCompanyCollection->create();
        $companies = array();

        foreach ($collection as $company) {
            $companies[] = $this->_customerCompanyRepository->getById($company->getNetsuiteId());
        }

        return $companies;
    }
}