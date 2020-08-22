<?php

namespace Orders\Custom\Model;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;

class OrderManagement implements \Orders\Custom\Api\OrderManagementInterface
{
    protected $_storeManager;
    protected $_productRepository;
    protected $_cartRepositoryInterface;
    protected $_cartManagementInterface;
    protected $_customerFactory;
    protected $_customerRepository;
    protected $_order;
    protected $_orderRepository;
    protected $_orderResourceModel;
    protected $_addressRepository;
    protected $_logger;
    protected $_orderCustomRepository;
    protected $_currencyFactory;
    protected $_companyRepository;
    protected $_netsuiteItemRepository;
    protected $_resourceModelOrderCustom;
    protected $_orderItemRepository;
    protected $_orderAddressRepository;
    protected $_quote;
    protected $_addressResourceModel;
    protected $_triggerIndex;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Quote\Api\CartRepositoryInterface $cartRepositoryInterface,
        \Magento\Quote\Api\CartManagementInterface $cartManagementInterface,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Sales\Model\Order $order,
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository,
        \Magento\Sales\Model\ResourceModel\Order $orderResourceModel,
        \Magento\Directory\Model\CurrencyFactory $currencyFactory,
        \Magento\Sales\Model\Order\AddressRepository $addressRepository,
        \File\CustomLog\Logger\Logger $logger,
        \Orders\Custom\Api\OrderCustomRepositoryInterface $orderCustomRepository,
        \Customers\Company\Api\CompanyRepositoryInterface $companyRepository,
        \Items\ItemInformation\Api\NetSuiteItemRepositoryInterface $netsuiteItemRepository,
        \Orders\Custom\Model\ResourceModel\OrderCustom $resourceModelOrderCustom,
        \Magento\Sales\Api\OrderItemRepositoryInterface $orderItemRepository,
        \Magento\Sales\Api\OrderAddressRepositoryInterface $orderAddressRepository,
        \Magento\Quote\Model\Quote $quote,
        \Magento\Sales\Model\ResourceModel\Order\Address $addressResourceModel,
        \Orders\Custom\Helper\TriggerIndex $triggerIndex
    ) 
    {
        $this->_storeManager             = $storeManager;
        $this->_productRepository        = $productRepository;
        $this->_cartRepositoryInterface  = $cartRepositoryInterface;
        $this->_cartManagementInterface  = $cartManagementInterface;
        $this->_customerFactory          = $customerFactory;
        $this->_customerRepository       = $customerRepository;
        $this->_order                    = $order;
        $this->_orderRepository          = $orderRepository;
        $this->_orderResourceModel       = $orderResourceModel;
        $this->_addressRepository        = $addressRepository;
        $this->_logger                   = $logger;
        $this->_orderCustomRepository    = $orderCustomRepository;
        $this->_currencyFactory          = $currencyFactory;
        $this->_companyRepository        = $companyRepository;
        $this->_netsuiteItemRepository   = $netsuiteItemRepository;
        $this->_resourceModelOrderCustom = $resourceModelOrderCustom;
        $this->_orderItemRepository      = $orderItemRepository;
        $this->_orderAddressRepository   = $orderAddressRepository;
        $this->_quote                    = $quote;
        $this->_addressResourceModel     = $addressResourceModel;
        $this->_triggerIndex             = $triggerIndex;
    }

    /**
     * Create new order for a customer
     * 
     * @return string
     */
    public function createOrUpdateOrder()
    {
        try {
            $orderData = (array)json_decode(file_get_contents('php://input'), true);

            if (!array_key_exists('netsuite_id', $orderData)) {
                throw new CouldNotSaveException(__('The order does not have a netsuite id.'));
            }

            $this->_logger->info('update: '. $orderData['order_number']);

            // Replace the order if exists
            if($orderData['order_number'] !== null) 
            {
                $order = $this->_orderRepository->get($orderData['order_number']);
                $this->_orderRepository->delete($order);
            }

            $netsuiteId = $orderData['netsuite_id'];
            $poNumber = $orderData['purchase_order_number'];
            $storeId = 0;

            $store = $this->_storeManager->getStore();
            $websiteId = $this->_storeManager->getStore()->getWebsiteId();

            // Obtener customer por netsuite ID
            $customer = $this->_companyRepository->getCustomerByNetsuiteId($orderData['customer']);

            if(!$customer->getId()) {
                throw new CouldNotSaveException(__('The customer does not exist.'));
            }

            $cartId = $this->_cartManagementInterface->createEmptyCart(); 
            $quote = $this->_cartRepositoryInterface->get($cartId);
            $quote->setStore($store);

            $currencyCode = $orderData['currency_id'];
            $currency =  $this->_currencyFactory->create()->load($currencyCode);
            $this->_storeManager->getStore($storeId)->setCurrentCurrency($currency);
            $quote->setCurrency();

            $quote->assignCustomer($customer); //Assign quote to customer

            //add items in quote
            foreach($orderData['items'] as $item)
            {
                $itemId = $this->_netsuiteItemRepository->getByNetSuiteItemId($item['product_id'])->getItemId();
                if (!$itemId) {
                    throw new CouldNotSaveException(__('Some item does not exist.'));
                }
                $product = $this->_productRepository->getById($itemId);
                $quote->addProduct($product, intval($item['qty']));
            }

            //Set billing address to quote 
            $billingName = explode(" ", $orderData['billing_address']["address"]);
            $billingStreet = 'Apartment or suite: '.$orderData['billing_address']["apt_suite"].', '.
                                $orderData['billing_address']["state"].', '.$orderData['billing_address']["city"];
            $billingAddress = [
                                'firstname'            => $billingName[0],
                                'lastname'             => $billingName[1],
                                'street'               => $billingStreet,
                                'city'                 => $orderData['billing_address']["city"],
                                'country_id'           => $orderData['billing_address']["country"],
                                'region'               => $orderData['billing_address']["state"],
                                'postcode'             => $orderData['billing_address']["zip"],
                                'telephone'            => $orderData['billing_address']["telephone"],
                                'fax'                  => $orderData['billing_address']["fax"],
                                'save_in_address_book' => 0
                            ];
            $quote->getBillingAddress()->addData($billingAddress);

            //Set shipping address to quote
            $shippingName = explode(" ", $orderData['shipping_address']["address"]);
            $shippingStreet = 'Apartment or suite: '.$orderData['shipping_address']["apt_suite"].', '.
                                $orderData['shipping_address']["state"].', '.$orderData['shipping_address']["city"];
            $shippingAddress = [
                                'firstname'            => $shippingName[0],
                                'lastname'             => $shippingName[1],
                                'street'               => $shippingStreet,
                                'city'                 => $orderData['shipping_address']["city"],
                                'country_id'           => $orderData['shipping_address']["country"],
                                'region'               => $orderData['shipping_address']["state"],
                                'postcode'             => $orderData['shipping_address']["zip"],
                                'telephone'            => $orderData['shipping_address']["telephone"],
                                'fax'                  => $orderData['shipping_address']["fax"],
                                'save_in_address_book' => 0
                            ];
            $quote->getShippingAddress()->addData($shippingAddress);

            // Collect Rates and Set Shipping & Payment Method
            $shippingAddress = $quote->getShippingAddress();
            $shippingAddress->setCollectShippingRates(true)
                            ->collectShippingRates()
                            ->setShippingMethod('flatrate_flatrate'); //shipping method temporal
            $quote->setPaymentMethod('checkmo'); //payment method temporal
            $quote->setInventoryProcessed(false);

            // Set Sales Order Payment
            $quote->getPayment()->importData(['method' => 'checkmo']);
            $quote->save(); //Quote is ready

            // Collect Totals
            $quote->collectTotals();

            //Set indicator in order to trigger the afterPlace plugin
            $this->_triggerIndex->setValue(true);

            // Create Order From Quote
            $quote = $this->_cartRepositoryInterface->get($quote->getId());
            $orderId = $this->_cartManagementInterface->placeOrder($quote->getId());
            $order = $this->_order->load($orderId);            

            $order->setEmailSent(0);

            $this->_orderCustomRepository->save($orderId, $netsuiteId, $poNumber, $orderData['order_type']);

            if($order->getEntityId()) {
                $result = [
                    "order_number"=>(string)$orderId,
                    "error"=>null
                ];
            } else {
                $result = [
                    "order_number"=>null,
                    "error"=>"Could not create order"
                ];
            }

        } catch (Exception $error) {
            $result = [
                "order_number"=>null,
                "error"=>"Could not create order"
            ];
        }

        $response = json_encode($result);
        return $response;
    }

    /**
     * Update an order of a customer
     * 
     * @return string
     */
    public function updateOrder()
    {
        try {

            $data = (array) json_decode(file_get_contents('php://input'), true);

            $orderId = $data['order_number'];
            $order = $this->_orderRepository->get($orderId);
            $this->_logger->info($order->getQuoteId());
            $quote = $this->_quote->load($order->getQuoteId());

            //Update billing address
            $customerId = $this->_companyRepository->getCustomerByNetsuiteId($data['customer'])->getId();
            $billingAddress = $order->getBillingAddress();
            $billingName = explode(" ", $data['billing_address']["address"]);
            $billingStreet = 'Apartment or suite: '.$data['billing_address']["apt_suite"].', '.
                                $data['billing_address']["state"].', '.$data['billing_address']["city"];
            $billingAddress->setFirstname($billingName[0]);
            $billingAddress->setLastname($billingName[1]);
            $billingAddress->setCountryId($data['billing_address']["country"]);
            $billingAddress->setPostcode($data['billing_address']["zip"]);
            $billingAddress->setStreet($billingStreet);
            $billingAddress->setCity($data['billing_address']["city"]);
            $billingAddress->setTelephone($data['billing_address']["telephone"]);
            $billingAddress->setFax($data['billing_address']["fax"]);
            $billingAddress->setCustomerId($customerId);
            $this->_orderAddressRepository->save($billingAddress);

            //Update shipping address
            $orderObj = $this->_order->load($orderId);
            $shippingAddressId = $orderObj->getShippingAddress()->getEntityId();
            $shippingAddress = $this->_addressRepository->get($shippingAddressId);

            $this->_logger->info('shipping address',['return'=>$shippingAddress]);

            $shippingName = explode(" ", $data['shipping_address']["address"]);
            $shippingStreet = 'Apartment or suite: '.$data['shipping_address']["apt_suite"].', '.
                                $data['shipping_address']["state"].', '.$data['shipping_address']["city"];
            $shippingAddress->setFirstname($shippingName[0]);
            $shippingAddress->setLastname($shippingName[1]);
            $shippingAddress->setCountryId($data['shipping_address']["country"]);
            $shippingAddress->setRegionId($data['shipping_address']["state"]);
            $shippingAddress->setPostcode($data['shipping_address']["zip"]);
            $shippingAddress->setStreet($shippingStreet);
            $shippingAddress->setCity($data['shipping_address']["city"]);
            $shippingAddress->setTelephone($data['shipping_address']["telephone"]);
            $shippingAddress->setFax($data['shipping_address']["fax"]);
            $shippingAddress->setCustomerId($customerId);
            $this->_addressRepository->save($shippingAddress);

            //Items
            foreach($order->getAllItems() as $item) {
                $item->isDeleted(true);
            }

            foreach($data['items'] as $updateItem)
            {
                $updateItemId = $this->_netsuiteItemRepository->getByNetSuiteItemId($updateItem['product_id'])->getItemId();
                if (!$updateItemId) {
                    throw new CouldNotSaveException(__('Some item does not exist.'));
                }

                //add items to order

                foreach($order->getAllItems() as $item)
                {
                    $itemId = $this->_productRepository->get($item->getSku())->getId();

                    if($updateItemId == $itemId) 
                    {
                        // update item
                        $item->setQtyOrdered($updateItem['qty']);
                        $this->_orderItemRepository->save($item);
                    } 
                }
            }

            //Save order
            $quote->save();
            $this->_orderResourceModel->save($order);

            //Save extra information about order
            $orderCustom = $this->_orderCustomRepository->get($orderId, 'order_id');
            $orderCustom->setNetsuiteId($data['netsuite_id']);
            $orderCustom->setPurchaseOrder($data['purchase_order_number']);
            $orderCustom->setOrderType($data['order_type']);
            $this->_resourceModelOrderCustom->save($orderCustom);

            $result = [
                "status"=>true,
                "error"=>null
            ];

        } catch (Exception $error) {
            $result = [
                "status"=>false,
                "error"=>$error->getMessage()
            ];
        }

        $response = json_encode($result);
        return $response;
    }

    /**
     * Delete order
     * 
     * @return string
     */
    public function deleteOrder()
    {
        try {
            $data = (array)json_decode(file_get_contents('php://input'), true);

            $netsuiteId = null;

            if (!array_key_exists('netsuite_id', $data)) {
                throw new CouldNotDeleteException(__('There is not a netsuite id for the order.'));
            }else {
                $netsuiteId = $data['netsuite_id'];
            }

            $orderId = $this->_orderCustomRepository->getOrderIdByNetsuiteId($netsuiteId);
            $order = $this->_orderRepository->get($orderId);
            $isDeleted = $this->_orderRepository->delete($order);
            
            if($isDeleted) {
                $result = [
                    "status"=>true,
                    "error"=>null
                ];
            } else {
                throw new CouldNotDeleteException(__('Something went wrong when deleting the order.'));
            }

        } catch (Exception $error) {
            $result = [
                "status"=>false,
                "error"=>$error->getMessage()
            ];
        }

        $response = json_encode($result);
        return $response;
    }
}