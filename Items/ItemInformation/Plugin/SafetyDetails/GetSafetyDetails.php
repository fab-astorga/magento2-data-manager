<?php

namespace Items\ItemInformation\Plugin\SafetyDetails;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;

class GetSafetyDetails {

    protected $_safetyDetailsFactory;
    protected $_safetyDetailsRepository;

    public function __construct(
        \Items\ItemInformation\Model\SafetyDetailsFactory $safetyDetailsFactory,
        \Items\ItemInformation\Api\SafetyDetailsRepositoryInterface $safetyDetailsRepository
    ) 
    {
        $this->_safetyDetailsFactory = $safetyDetailsFactory;
        $this->_safetyDetailsRepository = $safetyDetailsRepository;
    }
    
    /**
     * Get or Save Safety Details of product
     *
     * @param ProductRepositoryInterface $subject
     * @param ProductInterface $product
     * @return ProductInterface
     */
    public function afterGet(ProductRepositoryInterface $subject, ProductInterface $product): ProductInterface
    {
        $productId = $product->getIdBySku($product->getSku());
        $safetyDetails;
        try {
            $safetyDetails = $this->_safetyDetailsRepository->getByProductId($productId);
        } catch(\Exception $error){
            $safetyDetails = $this->_safetyDetailsFactory->create();
            $safetyDetails->setItemId($productId);
            $this->_safetyDetailsRepository->save($safetyDetails);
        }
        $extensionAttributes = $product->getExtensionAttributes();
        $extensionAttributes->setSafetyDetails($safetyDetails);
        $product->setExtensionAttributes($extensionAttributes);

        return $product;
    }


    /**
     * Get or Save Safety Details of product
     *
     * @param ProductRepositoryInterface $subject
     * @param ProductInterface $product
     * @return ProductInterface
     */
    public function afterGetById(ProductRepositoryInterface $subject, ProductInterface $product): ProductInterface
    {
        $productId = $product->getIdBySku($product->getSku());
        $safetyDetails;
        try {
            $safetyDetails = $this->_safetyDetailsRepository->getByProductId($productId);
        } catch(\Exception $error){
            $safetyDetails = $this->_safetyDetailsFactory->create();
            $safetyDetails->setItemId($productId);
            $this->_safetyDetailsRepository->save($safetyDetails);
        }
        $extensionAttributes = $product->getExtensionAttributes();
        $extensionAttributes->setSafetyDetails($safetyDetails);
        $product->setExtensionAttributes($extensionAttributes);

        return $product;
    }

}
