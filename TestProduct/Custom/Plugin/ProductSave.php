<?php
namespace TestProduct\Custom\Plugin;

use Magento\Framework\Exception\CouldNotSaveException;

class ProductSave
{
    protected $_productExtensionFactory;
    protected $_attributeFactory;
    protected $_logger;

    public function __construct(
        \Magento\Catalog\Api\Data\ProductExtensionFactory $productExtensionFactory,
        \TestProduct\Custom\Model\AttributeFactory $attributeFactory,
        \Psr\Log\LoggerInterface $logger
    ) 
    {
        $this->_productExtensionFactory = $productExtensionFactory;
        $this->_attributeFactory = $attributeFactory;
        $this->_logger = $logger;
    }

    public function afterSave (
        \Magento\Catalog\Api\ProductRepositoryInterface $subject,
        \Magento\Catalog\Api\Data\ProductInterface $resultProduct
    )
    {
        $resultProduct = $this->saveCustomAttribute($resultProduct);
        return $resultProduct;
    }

    private function saveCustomAttribute(\Magento\Catalog\Api\Data\ProductInterface $product)
    {
        $this->_logger->addDebug("--------------------AFTER SAVE--------------------");
        $onlinePricesAttributeProductId = $product->getEntityId();
        $price1 = 88.5;
        $price2 = 85.5;
        $price3 = 69.5;
        $price4 = 32.5;
        $price5 = 5.5;

        $onlinePricesAttribute = $this->_attributeFactory->create();        
        $onlinePricesAttribute->setEntityId( $onlinePricesAttributeProductId );
        $onlinePricesAttribute->setQty48( $price1 );
        $onlinePricesAttribute->setQty144( $price2 );
        $onlinePricesAttribute->setQty288( $price3 );
        $onlinePricesAttribute->setQty576( $price4 );
        $onlinePricesAttribute->setQty1008( $price5 );
        $onlinePricesAttribute->save();
       
        return $product;
    }
}