<?php

namespace Entity\ProductManager\Model;

use \Entity\ProductManager\Api\ProductRepositoryInterface;

/**
 * Rest API to get products by ID
 */
class ProductRepository implements ProductRepositoryInterface
{
    protected $_productFactory;
    protected $_productRepository;
    protected $_logger;

    /**
     * ProductRepository constructor
     * @param \Magento\Catalog\Api\Data\ProductInterfaceFactory $productFactory
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
     * @param File\CustomLog\Logger\Logger $logger
     */
    public function __construct
    (
        \Magento\Catalog\Api\Data\ProductInterfaceFactory $productFactory,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \File\CustomLog\Logger\Logger $logger
    )
    {
        $this->_productFactory = $productFactory;
        $this->_productRepository = $productRepository;
        $this->_logger = $logger;
    }

    /**
     * Create product
     * @return string
     */
    public function createProduct()
    {
        $this->_logger->info('------CREATE PRODUCT------');

        try {
            $product = $this->_productFactory->create();
            $product->setSku('ProductJ');
            $product->setName('ProductJ');
            $product->setDescription("Product Description");
            $product->setShortDescription("Product Short Description");
            $product->setWebsiteIds([1]);
            $categories = ["1","2"]; //create an array of categories which you want to set for the product
            $product->setCategoryIds($categories);
            $product->setTypeId(\Magento\Catalog\Model\Product\Type::TYPE_VIRTUAL);
            $product->setVisibility(\Magento\Catalog\Model\Product\Visibility::VISIBILITY_BOTH); // To make product visible in both catalog,search
            $product->setPrice("Price of Product");
            $product->setAttributeSetId(4); // Attribute set for products
            $product->setStatus(\Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_ENABLED);
            $product->setUrlKey("blablablablabla");
            $testAttribute = 'whatever';
            $product->setCustomAttribute('test_attribute', $testAttribute);
            $product->setStockData(
                                    array(
                                        'use_config_manage_stock' => 0,
                                        'manage_stock' => 1,
                                        'is_in_stock' => 1,
                                        'qty' => 100
                                    )
                                );
            $product = $this->_productRepository->save($product);
            //To add images to product
           // $imagePath = "https://micoedward.com/wp-content/uploads/2018/04/Love-your-product.png"; //Set the full path of Image for product
           // $product->addImageToMediaGallery($imagePath, ['image', 'small_image', 'thumbnail'], false, false);
            $product->save();
            return 'Product created';

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}