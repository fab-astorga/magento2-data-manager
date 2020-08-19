<?php
namespace Orders\Custom\Model;

class OrderManagement implements \Orders\Custom\Api\OrderManagementInterface
{
    protected $_storeManager;
    protected $_product;
    protected $_cartRepositoryInterface;
    protected $_cartManagementInterface;
    protected $_customerFactory;
    protected $_customerRepository;
    protected $_order;
    protected $_orderRepository;
    protected $_emailSender;
    protected $_logger;
    protected $_purchaseOrderRepository;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Catalog\Model\Product $product,
        \Magento\Quote\Api\CartRepositoryInterface $cartRepositoryInterface,
        \Magento\Quote\Api\CartManagementInterface $cartManagementInterface,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Sales\Model\Order $order,
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository,
        \Magento\Sales\Model\Order\Email\Sender\OrderSender $emailSender,
        \File\CustomLog\Logger\Logger $logger,
        \Orders\Custom\Api\PurchaseOrderRepositoryInterface $purchaseOrderRepository
    ) 
    {
        $this->_storeManager            = $storeManager;
        $this->_product                 = $product;
        $this->_cartRepositoryInterface = $cartRepositoryInterface;
        $this->_cartManagementInterface = $cartManagementInterface;
        $this->_customerFactory         = $customerFactory;
        $this->_customerRepository      = $customerRepository;
        $this->_order                   = $order;
        $this->_orderRepository         = $orderRepository;
        $this->_emailSender             = $emailSender;
        $this->_logger                  = $logger;
        $this->_purchaseOrderRepository = $purchaseOrderRepository;
    }

    /**
     * Create new order for a customer
     * 
     * @return string
     */
    public function createOrUpdateOrder()
    {
        try {

            // TENER EN CUENTA EL NETSUITE ID Y EL PO (ORDER EXTRA ATTRS)

            // VERIFICAR SI LA ORDEN YA EXISTE !!!!

            $order = (array)json_decode(file_get_contents('php://input'), true);

            $store = $this->_storeManager->getStore();
            $websiteId = $this->_storeManager->getStore()->getWebsiteId();

            $customer = $this->_customerFactory->create();
            $customer->setWebsiteId($websiteId);
            $customer->loadByEmail($orderData['email']); // load customer by email address

            if(!$customer->getEntityId())
            {
                //If not avilable then create this customer
                $customer->setWebsiteId($websiteId)
                        ->setStore($store)
                        ->setFirstname($orderData['shipping_address']['firstname'])
                        ->setLastname($orderData['shipping_address']['lastname'])
                        ->setEmail($orderData['email']) 
                        ->setPassword($orderData['email']);
                $customer->save();
            }
            
            $cartId = $this->_cartManagementInterface->createEmptyCart(); //Create empty cart
            $quote = $this->_cartRepositoryInterface->get($cartId); // load empty cart quote
            $quote->setStore($store);

            // if you have allready buyer id then you can load customer directly 
            $customer = $this->_customerRepository->getById($customer->getEntityId());
            $quote->setCurrency();
            $quote->assignCustomer($customer); //Assign quote to customer

            //add items in quote
            foreach($orderData['items'] as $item)
            {
                $product = $this->_product->load($item['product_id']);
                $product->setPrice($item['price']);
                $quote->addProduct($product, intval($item['qty']));
            }

            //Set Address to quote
            $quote->getBillingAddress()->addData($orderData['shipping_address']);
            $quote->getShippingAddress()->addData($orderData['shipping_address']);

            // Collect Rates and Set Shipping & Payment Method
            $shippingAddress = $quote->getShippingAddress();
            $shippingAddress->setCollectShippingRates(true)
                            ->collectShippingRates()
                            ->setShippingMethod('flatrate_flatrate'); //shipping method
            $quote->setPaymentMethod('checkmo'); //payment method
            $quote->setInventoryProcessed(false); //not effetc inventory

            // Set Sales Order Payment
            $quote->getPayment()->importData(['method' => 'checkmo']);
            $quote->save(); //Now Save quote and your quote is ready

            // Collect Totals
            $quote->collectTotals();

            // Create Order From Quote
            $quote = $this->_cartRepositoryInterface->get($quote->getId());
            $orderId = $this->_cartManagementInterface->placeOrder($quote->getId());
            $order = $this->_order->load($orderId);

            $order->setEmailSent(0);
            $increment_id = $order->getRealOrderId();
            $this->_emailSender->send($order);

            if($order->getEntityId()) {
                $result = [
                    "status"=>true,
                    "error"=>null
                ];
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

            $orderId = $this->_purchaseOrderRepository->getOrderIdByNetsuiteId($netsuiteId);
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