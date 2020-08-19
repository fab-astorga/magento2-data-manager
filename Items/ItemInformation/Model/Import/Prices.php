<?php

namespace Items\ItemInformation\Model\Import;

use Exception;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Json\Helper\Data as JsonHelper;
use Magento\ImportExport\Helper\Data as ImportHelper;
use Magento\ImportExport\Model\Import;
use Magento\ImportExport\Model\Import\Entity\AbstractEntity;
use Magento\ImportExport\Model\Import\ErrorProcessing\ProcessingErrorAggregatorInterface;
use Magento\ImportExport\Model\ResourceModel\Helper;
use Magento\ImportExport\Model\ResourceModel\Import\Data;
use \Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\CouldNotSaveException;
use Items\ItemInformation\Api\ItemManagementInterface;
use Items\ItemInformation\Model\ResourceModel\Prices\PricesLink;


/**
 * Class Courses
 */
class Prices extends AbstractEntity
{
    const ENTITY_CODE = 'prices';
    const TABLE = 'item_net_price_usa';
    const ENTITY_ID_COLUMN = 'item_id';

    /**
     * If we should check column names
     */
    protected $needColumnCheck = true;

    /**
     * Need to log in import history
     */
    protected $logInHistory = true;

    /**
     * Permanent entity columns.
     */
    protected $_permanentAttributes = [
        'price_level', 
        'currency', 
        'sku', 
        'min_quantity', 
        'unit_price'
    ];

    /**
     * Valid column names
     */
    protected $validColumnNames = [
        'price_level', 
        'currency', 
        'sku', 
        'min_quantity', 
        'unit_price'
    ];

    /**
     * @var AdapterInterface
     */
    protected $connection;

    /**
     * @var ResourceConnection
     */
    private $resource;

    protected $_productRepository;
    protected $_pricesManagement;
    protected $_logger;

    /**
     * Courses constructor.
     *
     * @param JsonHelper $jsonHelper
     * @param ImportHelper $importExportData
     * @param Data $importData
     * @param ResourceConnection $resource
     * @param Helper $resourceHelper
     * @param ProcessingErrorAggregatorInterface $errorAggregator
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
     * @param \Items\ItemInformation\Api\PricesManagementInterface $pricesManagement
     * @param \File\CustomLog\Logger\Logger $logger
     */
    public function __construct(
        JsonHelper $jsonHelper,
        ImportHelper $importExportData,
        Data $importData,
        ResourceConnection $resource,
        Helper $resourceHelper,
        ProcessingErrorAggregatorInterface $errorAggregator,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Items\ItemInformation\Api\PricesManagementInterface $pricesManagement,
        \File\CustomLog\Logger\Logger $logger
    ) {
        $this->_productRepository = $productRepository;
        $this->jsonHelper = $jsonHelper;
        $this->_importExportData = $importExportData;
        $this->_resourceHelper = $resourceHelper;
        $this->_dataSourceModel = $importData;
        $this->resource = $resource;
        $this->connection = $resource->getConnection(ResourceConnection::DEFAULT_CONNECTION);
        $this->errorAggregator = $errorAggregator;
        $this->initMessageTemplates();
        $this->logger = $logger;
        $this->_productRepository = $productRepository;
        $this->_pricesManagement = $pricesManagement;
        $this->_logger = $logger;
    }

    /**
     * Entity type code getter.
     *
     * @return string
     */
    public function getEntityTypeCode()
    {
        return static::ENTITY_CODE;
    }

    /**
     * Get available columns
     *
     * @return array
     */
    public function getValidColumnNames(): array
    {
        return $this->validColumnNames;
    }

    /**
     * Row validation
     *
     * @param array $rowData
     * @param int $rowNum
     *
     * @return bool
     */
    public function validateRow(array $rowData, $rowNum): bool
    {
        $priceLevel = $rowData['price_level'] ?? '';
        $currency = $rowData['currency'] ?? '';
        $sku = $rowData['sku'] ?? '';
        $minQuantity = $rowData['min_quantity'] ?? '';
        $unitPrice = $rowData['unit_price'] ?? '';
    
        if (!$priceLevel) {
            $this->addRowError('Price level required', $rowNum);
        }

        if (!$currency) {
            $this->addRowError('Currency required', $rowNum);
        }

        if (!$sku) {
            $this->addRowError('SKU required', $rowNum);
        }

        if (!empty($minQuantity)) {
            $this->addRowError('Min quantity required', $rowNum);
        }

        if (!$unitPrice) {
            $this->addRowError('Unit price required', $rowNum);
        }

    
        if (isset($this->_validatedRows[$rowNum])) {
            return !$this->getErrorAggregator()->isRowInvalid($rowNum);
        }
    
        $this->_validatedRows[$rowNum] = true;
    
        return !$this->getErrorAggregator()->isRowInvalid($rowNum);
    }

    /**
     * Import data
     *
     * @return bool
     *
     * @throws Exception
     */
    protected function _importData(): bool
    {
        switch ($this->getBehavior()) {
            case Import::BEHAVIOR_DELETE:
                $this->deleteEntity();
                break;
            case Import::BEHAVIOR_REPLACE:
                $this->saveAndReplaceEntity();
                break;
            case Import::BEHAVIOR_APPEND:
                $this->saveAndReplaceEntity();
                break;
        }

        return true;
    }

    /**
     * Delete entities
     *
     * @return bool
     */
    private function deleteEntity(): bool
    {
        while ($bunch = $this->_dataSourceModel->getNextBunch()) 
        {
            $entityList = [];

            foreach ($bunch as $rowNum => $row) {
                if (!$this->validateRow($row, $rowNum)) {
                    continue;
                }

                if ($this->getErrorAggregator()->hasToBeTerminated()) {
                    $this->getErrorAggregator()->addRowToSkip($rowNum);

                    continue;
                }

                $columnValues = [];

                foreach ($this->getAvailableColumns() as $columnKey) {
                    $columnValues[$columnKey] = $row[$columnKey];
                }
                $this->countItemsDeleted += 1;
                $entityList[] = $columnValues;
            }
            if ($entityList) {
                $this->deleteEntities($entityList);
            }
        }

        return false;
    }

    /**
     * Save and replace entities
     *
     * @return void
     */
    private function saveAndReplaceEntity()
    {
        $behavior = $this->getBehavior();
        while ($bunch = $this->_dataSourceModel->getNextBunch())
        {
            $entityList = [];

            foreach ($bunch as $rowNum => $row) {
                if (!$this->validateRow($row, $rowNum)) {
                    continue;
                }

                if ($this->getErrorAggregator()->hasToBeTerminated()) {
                    $this->getErrorAggregator()->addRowToSkip($rowNum);

                    continue;
                }

                $columnValues = [];

                foreach ($this->getAvailableColumns() as $columnKey) {
                    $columnValues[$columnKey] = $row[$columnKey];
                }

                $entityList[] = $columnValues;
                $this->countItemsCreated += (int) !isset($row[static::ENTITY_ID_COLUMN]);
                $this->countItemsUpdated += (int) isset($row[static::ENTITY_ID_COLUMN]);
            }

            if (Import::BEHAVIOR_REPLACE === $behavior) 
            {
                $this->deleteEntities($entityList);
                $this->saveEntities($entityList);
            } elseif (Import::BEHAVIOR_APPEND === $behavior) 
            {
                $this->saveEntities($entityList);
            }
        }
    }

    /**
     * Get available columns
     *
     * @return array
     */
    private function getAvailableColumns(): array
    {
        return $this->validColumnNames;
    }

    /**
     * Init Error Messages
     */
    private function initMessageTemplates()
    {
        $this->addMessageTemplate(
            'NameIsRequired',
            __('The name cannot be empty.')
        );
        $this->addMessageTemplate(
            'DurationIsRequired',
            __('Duration should be greater than 0.')
        );
    }
    
    private function saveEntities($entityList)
    {
        // Prices object to insert
        $prices = [];

        // The first SKU of the CSV (child -> 'parent : child')
        $lastSku = $entityList[0]['sku'];

        $this->_logger->info( 'LAST SKU: '.$lastSku );

        if(strpos($lastSku, ' : '))
        {
            $skus = explode(' : ', $lastSku);
            $lastSku = $skus[1];
        }

        $this->_logger->info( 'LAST SKU AFTER EXPLODE: '.$lastSku );

        // We get the currency and price level
        $currency = $entityList[0]['currency'];
        $priceLevel = $entityList[0]['price_level'];
        $prices['currency'] = $currency;
        $prices['price_level'] = $priceLevel;

        $this->_logger->info( 'currency: '.$currency );
        $this->_logger->info( 'price level: '.$priceLevel );

        // Init price_level set
        $prices['price_level_set'] = [];

        // init unique price
        $price = [];
        foreach ($entityList as $entity)
        { 
            // Get current sku
            $currentSku = $entity['sku'];
            if(strpos($currentSku, ' : '))
            {
                $skus = explode(' : ', $currentSku);
                $currentSku = $skus[1];
            }

            // We need to get a list of prices for each SKU of the CSV
            if ($lastSku != $currentSku){
                // Get product
                $product = $this->_productRepository->get($lastSku);
                // Set prices object
                $finalPrices['prices'][] =  $prices;
                // Save prices
                $this->_pricesManagement->savePrices($product, $finalPrices);
                // Reset price level set and current sku
                $prices['price_level_set'] = [];
                $lastSku = $currentSku;
            }
            // Add price to price level set
            $price['min_quantity'] = $entity['min_quantity'];
            $price['unit_price'] = $entity['unit_price'];
            $prices['price_level_set'][] = $price;
            $price = [];
        }
        // Save last prices
        if(count($prices['price_level_set']) > 0)
        {
            $product = $this->_productRepository->get($lastSku);
            $finalPrices['prices'][] =  $prices;
            $this->_pricesManagement->savePrices($product, $finalPrices);
        }

        $this->_logger->info( 'FINAL PRICES', ['return'=>$prices] );
    }

    /**
     * Delete prices
     * 
     * @param array $entityList
     * @return bool
     */
    private function deleteEntities($entityList)
    {
        $lastSku = $entityList[0]['sku'];
        if(strpos($lastSku, ' : ')){
            $skus = explode(' : ', $lastSku);
            $lastSku = $skus[1];
        }

        // We get the currency and price level
        $currency = $entityList[0]['currency'];
        $priceLevel = $entityList[0]['price_level'];
        $table;
        if($currency == 'USA'){
            $table = $this->_pricesManagement->getUSAPriceTable($priceLevel);
        }else if ($currency == 'Canadian Dollar') {
            $table = $this->_pricesManagement->getCanadianPriceTable($priceLevel);
        } else {
            throw new CouldNotSaveException(__('Incorrect currency'));
        }
        // Init price_level set
        foreach ($entityList as $entity) 
        { 
            // Get current sku
            $currentSku = $entity['sku'];
            if(strpos($currentSku, ' : ')){
                $skus = explode(' : ', $currentSku);
                $currentSku = $skus[1];
            }
            // We need to get diferent skus
            if ($lastSku != $currentSku){
                $product = $this->_productRepository->get($lastSku);
                $productId = $product->getId();
                // Delete prices
                $condition = ['item_id = ?' => (int) $productId];
                $this->connection->delete($table, $condition);
            
                $lastSku = $currentSku;
            }
            // Delete last prices
            $product = $this->_productRepository->get($lastSku);
            $productId = $product->getId();
            $condition = ['item_id = ?' => (int) $productId];
            $this->connection->delete($table, $condition);
        }

        return true;
    }
}