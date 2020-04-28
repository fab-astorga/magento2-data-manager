<?php
namespace TestOrder\Custom\Plugin;

use Magento\Framework\Exception\CouldNotSaveException;

class OrderSave
{
    protected $_logger;

    public function __construct(\Psr\Log\LoggerInterface $logger) 
    {
        $this->_logger = $logger;
    }

    public function afterSave (
        \Magento\Sales\Api\OrderRepositoryInterface $subject,
        \Magento\Sales\Api\Data\OrderInterface $resultOrder
    ) {
        $resultOrder = $this->saveCustomAttribute($resultOrder);
       // $this->_logger->addDebug('after SAVEEEE hereeeeee!!!!');
        return $resultOrder;
    }

    private function saveCustomAttribute(\Magento\Sales\Api\Data\OrderInterface $order)
    {
        $extensionAttributes = $order->getExtensionAttributes();
        if (null !== $extensionAttributes &&
            null !== $extensionAttributes->getOrderCustomAttribute()
        ) {
            /* @var \Magento\GiftMessage\Api\Data\MessageInterface $giftMessage */
            $customAttribute = $extensionAttributes->getOrderCustomAttribute();
            try
            {
                //$customAttribute->save();

            } catch (\Exception $e) {
                throw new CouldNotSaveException(
                __('An error occurred on the server. Please try to place the order again.'),
                $e);
            }
        }
        return $order;
    }
}