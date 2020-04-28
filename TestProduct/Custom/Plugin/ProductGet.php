<?php

namespace TestProduct\Custom\Plugin;

use Magento\Framework\Exception\NoSuchEntityException;

class ProductGet
{
    protected $_productExtensionFactory;
    protected $_attributeFactory;
    protected $_logger;

    public function __construct(
        \Magento\Catalog\Api\Data\ProductExtensionFactory $productExtensionFactory,
        \TestProduct\Custom\Model\AttributeFactory $attributeFactory,
        \File\CustomLog\Logger\Logger $logger
    ) {
        $this->_productExtensionFactory = $productExtensionFactory;
        $this->_attributeFactory = $attributeFactory;
        $this->_logger = $logger;
    }

    public function afterGet (
        \Magento\Catalog\Api\ProductRepositoryInterface $subject,
        \Magento\Catalog\Api\Data\ProductInterface $resultProduct
    ) {
        $resultProduct = $this->getCustomAttribute($resultProduct);
        return $resultProduct;
    }

    private function getCustomAttribute(\Magento\Catalog\Api\Data\ProductInterface $product )
    {
        try {
            $onlinePrices = $this->_attributeFactory->create();
            $onlinePrices->load($product->getEntityId());
            if (! $onlinePrices->getEntityId()) {
                throw new NoSuchEntityException();
            }

        } catch (NoSuchEntityException $e) {
            return $product;
        }

        $this->_logger->info("--------------------AFTER GET--------------------");

        $extensionAttributes = $product->getExtensionAttributes();
        $productExtension = $extensionAttributes ? $extensionAttributes : $this->_productExtensionFactory->create();
        $productExtension->setOnlinePrices($onlinePrices);
        $product->setExtensionAttributes($productExtension);

        return $product;
    }
}