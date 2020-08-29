<?php

namespace Items\ItemInformation\Plugin\ItemDetails;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;

class GetItemDetails {

    protected $_itemDetailsFactory;
    protected $_itemDetailsRepository;

    public function __construct(
        \Items\ItemInformation\Model\ItemDetailsFactory $itemDetailsFactory,
        \Items\ItemInformation\Api\ItemDetailsRepositoryInterface $itemDetailsRepository
    ) 
    {
        $this->_itemDetailsFactory = $itemDetailsFactory;
        $this->_itemDetailsRepository = $itemDetailsRepository;
    }
    
    /**
     * Get or Save Item Details of product
     *
     * @param ProductRepositoryInterface $subject
     * @param ProductInterface $product
     * @return ProductInterface
     */
    public function afterGet(ProductRepositoryInterface $subject, ProductInterface $product): ProductInterface
    {
        $productId = $product->getIdBySku($product->getSku());
        $itemDetails;
        try {
            $itemDetails = $this->_itemDetailsRepository->getByProductId($productId);
        } catch(\Exception $error){
            $itemDetails = $this->_itemDetailsFactory->create();
            $itemDetails->setItemId($productId);
            $this->_itemDetailsRepository->save($itemDetails);
        }
        $extensionAttributes = $product->getExtensionAttributes();
        $extensionAttributes->setItemDetails($itemDetails);
        $product->setExtensionAttributes($extensionAttributes);

        return $product;
    }

        /**
     * Get or Save Item Details of product
     *
     * @param ProductRepositoryInterface $subject
     * @param ProductInterface $product
     * @return ProductInterface
     */
    public function afterGetById(ProductRepositoryInterface $subject, ProductInterface $product): ProductInterface
    {
        $productId = $product->getIdBySku($product->getSku());
        $itemDetails;
        try {
            $itemDetails = $this->_itemDetailsRepository->getByProductId($productId);
        } catch(\Exception $error){
            $itemDetails = $this->_itemDetailsFactory->create();
            $itemDetails->setItemId($productId);
            $this->_itemDetailsRepository->save($itemDetails);
        }
        $extensionAttributes = $product->getExtensionAttributes();
        $extensionAttributes->setItemDetails($itemDetails);
        $product->setExtensionAttributes($extensionAttributes);

        return $product;
    }

}
