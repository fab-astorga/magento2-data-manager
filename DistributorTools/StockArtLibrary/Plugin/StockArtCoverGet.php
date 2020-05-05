<?php

namespace DistributorTools\StockArtLibrary\Plugin;

use Magento\Framework\Exception\NoSuchEntityException;

class StockArtCoverGet
{
    const FIELD = 'cover_id';

    protected $_stockArtCoverExtensionFactory;
    protected $_stockArtImagesAttributeFactory;
    protected $_stockArtImagesAttributeRepository;
    protected $_searchCriteriaBuilder;
    protected $_filterBuilder;
    protected $_logger;

    public function __construct (
        \DistributorTools\StockArtLibrary\Api\Data\StockArtCoverExtensionFactory $stockArtCoverExtensionFactory,
        \DistributorTools\StockArtLibrary\Model\StockArtImagesAttributeFactory $stockArtImagesAttributeFactory,
        \DistributorTools\StockArtLibrary\Api\StockArtImagesAttributeRepositoryInterface $stockArtImagesAttributeRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        \File\CustomLog\Logger\Logger $logger
    ) {
        $this->_stockArtCoverExtensionFactory = $stockArtCoverExtensionFactory;
        $this->_stockArtImagesAttributeFactory = $stockArtImagesAttributeFactory;
        $this->_stockArtImagesAttributeRepository = $stockArtImagesAttributeRepository;
        $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->_filterBuilder = $filterBuilder;
        $this->_logger = $logger;
    }

    public function afterGet (
        \DistributorTools\StockArtLibrary\Api\StockArtCoverRepositoryInterface $subject,
        \DistributorTools\StockArtLibrary\Api\Data\StockArtCoverInterface $resultStockArtCover
    ) {
        $resultStockArtCover = $this->getStockArtImagesAttribute($resultStockArtCover);
        return $resultStockArtCover;
    }

    private function getStockArtImagesAttribute(\DistributorTools\StockArtLibrary\Api\Data\StockArtCoverInterface $stockArtCover )
    {
        $stockArtCoverId = $stockArtCover->getId();

        try {
            $filter[] = $this->_filterBuilder
                        ->setField(self::FIELD)
                        ->setValue($stockArtCoverId)
                        ->setConditionType('eq')
                        ->create();
            
            $searchCriteria = $this->_searchCriteriaBuilder->addFilters($filter);
            $searchResults = $this->_stockArtImagesAttributeRepository->getList($searchCriteria->create());
            $stockArtImages = $searchResults->getItems();

        } catch (NoSuchEntityException $e) {
            return $stockArtCover;
        } 

        $extensionAttributes = $stockArtCover->getExtensionAttributes();
        $stockArtCoverExtension = $extensionAttributes ? $extensionAttributes : $this->_stockArtCoverExtensionFactory->create();
        $stockArtCoverExtension->setStockArtImagesAttribute($stockArtImages);
        $stockArtCover->setExtensionAttributes($stockArtCoverExtension); 

        return $stockArtCover;
    }
}