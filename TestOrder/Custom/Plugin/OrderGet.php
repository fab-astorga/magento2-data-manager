<?php
namespace TestOrder\Custom\Plugin;

use Magento\Framework\Exception\NoSuchEntityException;

class OrderGet
{
    protected $_orderExtensionFactory;
    protected $_attributeFactory;
    protected $_logger;
    protected $attribute;

    public function __construct(
        \Magento\Sales\Api\Data\OrderExtensionFactory $orderExtensionFactory,
        \TestOrder\Custom\Model\AttributeFactory $attributeFactory,
        \Psr\Log\LoggerInterface $logger,
        \TestOrder\Custom\Api\Data\AttributeInterface $attribute
    ) {
        $this->_orderExtensionFactory = $orderExtensionFactory;
        $this->_attributeFactory = $attributeFactory;
        $this->_logger = $logger;
        $this->attribute = $attribute;
    }

    public function afterGet(
        \Magento\Sales\Api\OrderRepositoryInterface $subject,
        \Magento\Sales\Api\Data\OrderInterface $resultOrder
    ) {
        $resultOrder = $this->getCustomAttribute($resultOrder);
        $this->_logger->addDebug('after get hereeeeee!!!!');
        
      // $extensionAttribute = $resultOrder->getExtensionAttributes();
      // $this->attribute->setBar("hola actualizado");
      // $resultOrder->getExtensionAttributes()->setOrderCustomAttribute($this->attribute);

        return $resultOrder;
    }

    private function getCustomAttribute(\Magento\Sales\Api\Data\OrderInterface $order)
    {
        try 
        {
            $customAttribute = $this->_attributeFactory->create();
            $customAttribute->load($order->getEntityId());
            if (! $customAttribute->getEntityId()) {
                throw new NoSuchEntityException();
            }

        } catch (NoSuchEntityException $e) {
            return $order;
        }

        $extensionAttributes = $order->getExtensionAttributes();
        $orderExtension = $extensionAttributes ? $extensionAttributes : $this->_orderExtensionFactory->create();

        $orderExtension->setOrderCustomAttribute($customAttribute);
        $order->setExtensionAttributes($orderExtension);

        return $order;
    }
}