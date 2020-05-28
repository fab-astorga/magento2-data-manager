<?php

namespace Customers\Manager\Model;

use Customers\Manager\Api\CustomersManagementInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;

class CustomersManagement implements CustomersManagementInterface 
{
    protected $_storeManager;
    protected $_customerInterface;
    protected $_encryptor;
    protected $_customerRepository;
    protected $_customerFactory;
    protected $_sessionFactory;
    protected $_accountManagement;
    protected $_redirect;
    protected $_logger;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Customer\Api\Data\CustomerInterfaceFactory $customerInterface,
        \Magento\Framework\Encryption\EncryptorInterface $encryptor,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Customer\Model\SessionFactory $sessionFactory,
        \Magento\Customer\Api\AccountManagementInterface $accountManagement,
        \Magento\Framework\App\Action\Context $context,
        \File\CustomLog\Logger\Logger $logger
    ) 
    {
        $this->_storeManager       = $storeManager;
        $this->_customerInterface  = $customerInterface;
        $this->_encryptor          = $encryptor;
        $this->_customerRepository = $customerRepository;
        $this->_customerFactory    = $customerFactory;
        $this->_sessionFactory     = $sessionFactory;
        $this->_accountManagement  = $accountManagement;
        $this->_logger             = $logger;
        $this->_redirect           = $context->getRedirect();
    }

    /**
     * {@inheritdoc}
     * 
     */
    public function createCustomer($email, $firstname, $lastname, $password)
    {
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

            return true;

        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e));
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
     * 
     */
    public function deleteCustomer($email)
    {
        try {
            $customer = $this->getCustomer($email);
            $this->_customerRepository->delete($customer);
            return true;

        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__($e));
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

        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e));
        }
    }

    /**
     * {@inheritdoc}
     * 
     */
    public function changePasswordCustomer($email, $actualPassword, $newPassword)
    {
        return $this->_accountManagement->changePassword($email, $actualPassword, $newPassword);
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
            $sessionManager = $this->_sessionFactory->create();
            $isLogin = $sessionManager->isLoggedIn($customer);
            if ($isLogin) {
                return "Customer is already login";
            }
            $sessionManager->setCustomerDataAsLoggedIn($customer);
            return "Customer login successfully";
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
        $sessionManager = $this->_sessionFactory->create();
        $customerId = $sessionManager->getId();

        if($customerId) 
        {
            $sessionManager->logout()
                            ->setBeforeAuthUrl($this->_redirect->getRefererUrl())
                            ->setLastCustomerId($customerId);

            return "Customer logout successfully";
        }
        else {
            return "Customer is not login";
        } 
    }
}