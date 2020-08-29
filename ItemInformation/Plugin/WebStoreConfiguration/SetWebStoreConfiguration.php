<?php

namespace Items\ItemInformation\Plugin\WebStoreConfiguration;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;

class SetWebStoreConfiguration {

    protected $_webStoreConfigurationFactory;
    protected $_webStoreConfigurationRepository;

    public function __construct(
        \Items\ItemInformation\Model\WebStoreConfigurationFactory $webStoreConfigurationFactory,
        \Items\ItemInformation\Api\WebStoreConfigurationRepositoryInterface $webStoreConfigurationRepository
    ) 
    {
        $this->_webStoreConfigurationFactory = $webStoreConfigurationFactory;
        $this->_webStoreConfigurationRepository = $webStoreConfigurationRepository;
    }
    
    /**
     * Save Safety Details of product
     *
     * @param ProductRepositoryInterface $subject
     * @param ProductInterface $product
     * @return ProductInterface
     */
    public function afterSave(ProductRepositoryInterface $subject, ProductInterface $product): ProductInterface
    {
        $productId = $product->getIdBySku($product->getSku());
        $webStoreConfiguration;
        try {
            $webStoreConfiguration = $this->_webStoreConfigurationRepository->getByProductId($productId);
        } catch(\Exception $error){
            $webStoreConfiguration = $this->_webStoreConfigurationFactory->create();
            $webStoreConfiguration->setData(WebStoreConfigurationInterface::ITEM_ID, $productId);
            $this->_webStoreConfigurationRepository->save($webStoreConfiguration);
        }
        $extensionAttributes = $product->getExtensionAttributes();
        $extensionAttributes->setWebStoreConfiguration($webStoreConfiguration);
        $product->setExtensionAttributes($extensionAttributes);

        return $product;
    }

}
