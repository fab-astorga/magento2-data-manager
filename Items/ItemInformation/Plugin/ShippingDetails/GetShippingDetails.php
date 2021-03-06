<?php

namespace Items\ItemInformation\Plugin\ShippingDetails;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;

class GetShippingDetails {

    protected $_shippingDetailsFactory;
    protected $_shippingDetailsRepository;

    public function __construct(
        \Items\ItemInformation\Model\ShippingDetailsFactory $shippingDetailsFactory,
        \Items\ItemInformation\Api\ShippingDetailsRepositoryInterface $shippingDetailsRepository
    ) 
    {
        $this->_shippingDetailsFactory = $shippingDetailsFactory;
        $this->_shippingDetailsRepository = $shippingDetailsRepository;
    }
    
    /**
     * Get or Save Shipping Details of product
     *
     * @param ProductRepositoryInterface $subject
     * @param ProductInterface $product
     * @return ProductInterface
     */
    public function afterGet(ProductRepositoryInterface $subject, ProductInterface $product): ProductInterface
    {
        $productId = $product->getIdBySku($product->getSku());
        $shippingDetails;
        try {
            $shippingDetails = $this->_shippingDetailsRepository->getByProductId($productId);
        } catch(\Exception $error){
            $shippingDetails = $this->_shippingDetailsFactory->create();
            $shippingDetails->setItemId($productId);
            $this->_shippingDetailsRepository->save($shippingDetails);
        }
        $extensionAttributes = $product->getExtensionAttributes();
        $extensionAttributes->setShippingDetails($shippingDetails);
        $product->setExtensionAttributes($extensionAttributes);

        return $product;
    }


    /**
     * Get or Save Shipping Details of product
     *
     * @param ProductRepositoryInterface $subject
     * @param ProductInterface $product
     * @return ProductInterface
     */
    public function afterGetById(ProductRepositoryInterface $subject, ProductInterface $product): ProductInterface
    {
        $productId = $product->getIdBySku($product->getSku());
        $shippingDetails;
        try {
            $shippingDetails = $this->_shippingDetailsRepository->getByProductId($productId);
        } catch(\Exception $error){
            $shippingDetails = $this->_shippingDetailsFactory->create();
            $shippingDetails->setItemId($productId);
            $this->_shippingDetailsRepository->save($shippingDetails);
        }
        $extensionAttributes = $product->getExtensionAttributes();
        $extensionAttributes->setShippingDetails($shippingDetails);
        $product->setExtensionAttributes($extensionAttributes);

        return $product;
    }

}
