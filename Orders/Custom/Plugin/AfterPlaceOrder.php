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
    const ORDER_TYPE = 'regular';

    protected $_logger;
    protected $_orderCustomRepository;
    protected $_netsuiteIntegration;
    protected $_order;
    protected $_netsuiteItemRepository;
    protected $_companyRepository;
    protected $_productRepository;
    protected $_triggerIndex;

    public function __construct(
        \File\CustomLog\Logger\Logger $logger,
        \Orders\Custom\Api\OrderCustomRepositoryInterface $orderCustomRepository,
        \Integration\Netsuite\Api\IntegrationInterface $netsuiteIntegration,
        \Magento\Sales\Model\Order $order,
        \Items\ItemInformation\Api\NetSuiteItemRepositoryInterface $netsuiteItemRepository,
        \Customers\Company\Api\CompanyRepositoryInterface $companyRepository,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Orders\Custom\Helper\TriggerIndex $triggerIndex

    )
    {
        $this->_logger                  = $logger;
        $this->_orderCustomRepository   = $orderCustomRepository;
        $this->_netsuiteIntegration     = $netsuiteIntegration;
        $this->_order                   = $order;
        $this->_netsuiteItemRepository  = $netsuiteItemRepository;
        $this->_companyRepository       = $companyRepository;
        $this->_productRepository       = $productRepository;
        $this->_triggerIndex            = $triggerIndex;
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
        $trigger = $this->_triggerIndex->getValue();

        if ($trigger) {
            $this->_triggerIndex->setValue(false);

        } else {
            if ($orderId) {
                try {
                    $customerId = $result->getCustomerId();
                    $customerNetsuiteId = $this->_companyRepository->get($customerId, 'customer_id')->getNetsuiteId();
                    
                    $orderObj = $this->_order->load($orderId);
                    $shippingAddress = $orderObj->getShippingAddress();
                    $shippingMethod = $orderObj->getShippingMethod();
                    $billingAddress = $result->getBillingAddress();

                    $script = 1759; // netsuite script
                    $deploy = 1;
                    $method = "POST";

                    $data = [
                        'netsuite_id'          => null,
                        'order_type'           => self::ORDER_TYPE,
                        'currency_id'          => $result->getOrderCurrencyCode(),
                        'customer'             => $customerNetsuiteId,
                        'order_number'         => $orderId,
                        'purchase_order_number'=> self::INITIAL_PO_STATUS,
                    // 'total'                => $result->getGrandTotal(),
                    // 'status'               => $result->getStatus(),
                        'shipping_address' => [
                            'address'	   => $shippingAddress->getFirstname().' '.$shippingAddress->getLastname(),
                            'apt_suite'	   => 'N/A',
                            'city'         => $shippingAddress->getCity(),
                            'country'      => $shippingAddress->getCountryId(),
                            'state'        => $shippingAddress->getState(),
                            'zip'          => $shippingAddress->getPostcode(),
                            'telephone'    => $shippingAddress->getTelephone(),
                            'fax'          => $shippingAddress->getFax()
                        ],
                        'billing_address'  => [
                            'address'	   => $billingAddress->getFirstname().' '.$billingAddress->getLastname(),
                            'apt_suite'	   => 'N/A',
                            'city'         => $billingAddress->getCity(),
                            'country'      => $billingAddress->getCountryId(),
                            'state'        => $billingAddress->getState(),
                            'zip'          => $billingAddress->getPostcode(),
                            'telephone'    => $billingAddress->getTelephone(),
                            'fax'          => $billingAddress->getFax()
                        ],
                        'items'                => $this->getOrderItems($result)
                    ];

                    $this->_logger->info('ORDER DATA',['return'=>$data]);

                //  $result = $this->_netsuiteIntegration->sendNetsuiteRequest($data, $method, $script, $deploy);
                //  $response = json_encode($result, true);
                //  if(!empty($response['error'])) {
                //    return $response['error'];
                // }
                // $this->_orderCustomRepository->save($orderId, $response['netsuite_id'], self::INITIAL_PO_STATUS, self::ORDER_TYPE);

                } catch (Exception $e) {
                    throw new Exception(__('Something went wrong when sending order to Netsuite.'));
                }
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
            $itemId = $this->_productRepository->get($item->getSku())->getId();
            $itemNetsuiteId = $this->_netsuiteItemRepository->get($itemId,'item_id')->getNetSuiteItemId();
            $tmpItem = [
                'product_id' => $itemNetsuiteId,
                'qty'        => $item->getQtyOrdered()
            ];
            $result[] = $tmpItem;
        }

        return $result;
    }
}