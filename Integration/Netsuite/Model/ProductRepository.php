<?php

namespace Integration\Netsuite\Model;

use Integration\Netsuite\Api\ConfigurableProductRepositoryInterface;
use Integration\Netsuite\Api\ProductRepositoryInterface;
use Integration\Netsuite\Api\Data\ProductInterfaceFactory; 
use Integration\Netsuite\Helper\ProductHelper;
use \Magento\Framework\Exception\NoSuchEntityException;

/**
 * Rest API to get products by ID
 */
class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @var ProductInterfaceFactory
     */
    private $productInterfaceFactory;
    /**
     * @var ProductHelper
     */
    private $productHelper;
    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * ProductRepository constructor
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
     * @param ProductInterfaceFactory $productInterfaceFactory
     * @param ProductHelper $productHelper
     */
    public function __construct
    (
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        ProductRepositoryInterface $productInterfaceFactory,
        ProductHelper $productHelper
    )
    {
        $this->productRepository = $productRepository;
        $this->productInterfaceFactory = $productInterfaceFactory;
        $this->productHelper = $productHelper;
    }

    /**
     * Get product by its ID
     * 
     * @param int $id
     * @return \Integration\Netsuite\Api\Data\ProductInterface
     * @throws NoSuchEntityException
     */
    public function getProductById($id)
    {
        /** @var \Integration\Netsuite\Api\Data\ProductInterface */
        $productInterface = $this->productInterfaceFactory->create();
        try {
            /** @var \Integration\Netsuite\Api\Data\ProductInterface $product */
            $product = $this->productRepository->getById($id);
            $productInterface->setId( $product->getId() );
            $productInterface->setSku( $product->getSku() );
            $productInterface->setName( $product->getName() );
            // $productInterface->setDescription( $product->getDescription() ? $product->getDescription() : "" );
            $productInterface->setPrice( $this->productHelper->formatPrice($product->getPrice()) );
            // $productInterface->setImages( $this->productHelper->getProductImagesArray($product) );
            return $productInterface;
        } catch ( NoSuchEntityException $e ) {
            throw NoSuchEntityException::singleField("id", $id);
        }
    }
}