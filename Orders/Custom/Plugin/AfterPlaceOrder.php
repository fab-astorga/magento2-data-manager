<?php

namespace Orders\Custom\Plugin;

use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\OrderManagementInterface;

/**
 * Class AfterPlaceOrder
 */
class AfterPlaceOrder
{
    const INITIAL_PO_STATUS = 'Pending to generate';

    protected $_logger;
    protected $_purchaseOrderRepository;
    protected $_netsuiteIntegration;
    protected $_order;

    public function __construct(
        \File\CustomLog\Logger\Logger $logger,
        \Orders\Custom\Api\PurchaseOrderRepositoryInterface $purchaseOrderRepository,
        \Integration\Netsuite\Api\IntegrationInterface $netsuiteIntegration,
        \Magento\Sales\Model\Order $order
    )
    {
        $this->_logger                  = $logger;
        $this->_purchaseOrderRepository = $purchaseOrderRepository;
        $this->_netsuiteIntegration     = $netsuiteIntegration;
        $this->_order                   = $order;
    }

    /**
     * @param OrderManagementInterface $subject
     * @param OrderInterface           $order
     *
     * @return OrderInterface
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterPlace(OrderManagementInterface $subject, OrderInterface $result) 
    {
        $orderId = $result->getIncrementId();

        if ($orderId)
        {
            try {
                $this->_purchaseOrderRepository->save($orderId, 2828, self::INITIAL_PO_STATUS);

                $orderObj = $this->_order->load($orderId);
                $shippingAddress = $orderObj->getShippingAddress();
                $shippingMethod = $orderObj->getShippingMethod();
                $billingAddress = $result->getBillingAddress();

                $script = 1759;
                $deploy = 1;
                $method = "POST";

                $data = [
                    'currency_id'          => $result->getOrderCurrencyCode(),
                    'email'                => $result->getCustomerEmail(),
                    'order_number'         => $orderId,
                    'purchase_order_number'=> self::INITIAL_PO_STATUS,
                    'total'                => $result->getGrandTotal(),
                    'status'               => $result->getStatus(),
                    'shipping_address' => [
                        'firstname'	   => $shippingAddress->getFirstname(),
                        'lastname'	   => $shippingAddress->getLastname(),
                        'street'       => $shippingAddress->getStreet(),
                        'city'         => $shippingAddress->getCity(),
                        'country_id'   => $shippingAddress->getCountryId(),
                        'region'       => $shippingAddress->getRegion(),
                        'postcode'     => $shippingAddress->getPostcode(),
                        'telephone'    => $shippingAddress->getTelephone(),
                        'fax'          => $shippingAddress->getFax()
                    ],
                    'billing_address'  => [
                        'firstname'	   => $billingAddress->getFirstname(),
                        'lastname'	   => $billingAddress->getLastname(),
                        'street'       => $billingAddress->getStreet(),
                        'city'         => $billingAddress->getCity(),
                        'country_id'   => $billingAddress->getCountryId(),
                        'region'       => $billingAddress->getRegion(),
                        'postcode'     => $billingAddress->getPostcode(),
                        'telephone'    => $billingAddress->getTelephone(),
                        'fax'          => $billingAddress->getFax()
                    ],
                    'items'                => $this->getOrderItems($result),
                    'payment_method'       => $result->getPayment()->getMethod(),
                    'shipping_method'      => $shippingMethod
                ];

                $this->_logger->info('ORDER DATA',['return'=>$data]);


              //  $this->_netsuiteIntegration->sendNetsuiteRequest($data, $method, $script, $deploy);

            } catch (Exception $e) {
                $this->_logger->info('Order exception: '.$e->getMessage());
            } 
        }

        return $result;
    }

    /**
     * Get all items of an order
     * 
     * @param OrderInterface $order
     * @return array
     */
    public function getOrderItems($order)
    {
        $result = array();

        foreach($order->getItems() as $item)
        {
            $tmpItem = [
                'product_id' => $item->getItemId(),
                'price'      => $item->getPrice(),
                'qty'        => $item->getQtyOrdered()
            ];
            $result[] = $tmpItem;
        }

        return $result;
    }
}