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
use Items\ItemInformation\Api\ItemManagementInterface;

/**
 * Class Courses
 */
class Categories extends AbstractEntity
{
    const ENTITY_CODE = 'categories';
    const TABLE = 'catalog_category_entity';
    const ENTITY_ID_COLUMN = 'entity_id';

    protected $_categoryFactory;
	protected $_category;
	protected $_categoryRepository;

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
        'netsuite_id_child'
    ];

    /**
     * Valid column names
     */
    protected $validColumnNames = [
        'parent',
        'child',
        'netsuite_id_parent',
        'netsuite_id_child'
    ];

    /**
     * @var AdapterInterface
     */
    protected $connection;

    /**
     * @var ResourceConnection
     */
    private $resource;

    protected $logger;
    protected $_netsuiteCategoryRepository;
    protected $_netsuiteCategoryFactory;
    protected $_urlRewrite;

    /**
     * Courses constructor.
     *
     * @param JsonHelper $jsonHelper
     * @param ImportHelper $importExportData
     * @param Data $importData
     * @param ResourceConnection $resource
     * @param Helper $resourceHelper
     * @param ProcessingErrorAggregatorInterface $errorAggregator
     */
    public function __construct(
        JsonHelper $jsonHelper,
        ImportHelper $importExportData,
        Data $importData,
        ResourceConnection $resource,
        Helper $resourceHelper,
        ProcessingErrorAggregatorInterface $errorAggregator,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
		\Magento\Catalog\Model\Category $category,
        \Magento\Catalog\Api\CategoryRepositoryInterface $categoryRepository,
        \Items\ItemInformation\Api\NetSuiteCategoryRepositoryInterface $netsuiteCategoryRepository,
        \Items\ItemInformation\Model\NetSuiteCategoryFactory $netsuiteCategoryFactory,
        \Magento\UrlRewrite\Model\UrlRewrite $urlRewrite,
        \File\CustomLog\Logger\Logger $logger
    ) {
        $this->jsonHelper                  = $jsonHelper;
        $this->_importExportData           = $importExportData;
        $this->_resourceHelper             = $resourceHelper;
        $this->_dataSourceModel            = $importData;
        $this->resource                    = $resource;
        $this->connection                  = $resource->getConnection(ResourceConnection::DEFAULT_CONNECTION);
        $this->errorAggregator             = $errorAggregator;
        $this->_categoryFactory            = $categoryFactory;
		$this->_category                   = $category;
        $this->_categoryRepository         = $categoryRepository;
        $this->_netsuiteCategoryRepository = $netsuiteCategoryRepository;
        $this->_netsuiteCategoryFactory    = $netsuiteCategoryFactory;
        $this->_urlRewrite                 = $urlRewrite;
        $this->logger                      = $logger;
        $this->initMessageTemplates();
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
        $child = $rowData['child'] ?? '';
    
        if (!$child) {
            $this->addRowError('Child name required', $rowNum);
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
        switch ($this->getBehavior()) 
        {
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
        while ($bunch = $this->_dataSourceModel->getNextBunch()) {
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

                if ($this->getErrorAggregator()->hasToBeTerminated()) 
                {
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

            } elseif (Import::BEHAVIOR_APPEND === $behavior) {
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
        foreach ($entityList as $entity) { 
            $this->saveCategory($entity);
        }
    }

    public function saveCategory($categoryData)
    {
        // Incoming information
        $childCategoryNetsuiteId = null;
        $childName = null;
        $parentCategoryNetsuiteId = null;
        $parentName = null;

        $childCategoryNetsuiteId = $categoryData['netsuite_id_child'];
        $childName = $categoryData['child'];
        $parentCategoryNetsuiteId = $categoryData['netsuite_id_parent'];
        $parentName = $categoryData['parent'];

        // Map information
        $parentId = null;
        $childId = null;
        $productsCategoryId = null;

        // Default category:    Default Category -> Products Category
        $collection = $this->_categoryFactory->create()->getCollection()->addFieldToFilter('name', ['in'=> 'Default Category']);
        $defaultcategoryId = $collection->getFirstItem()->getId();

        // Products Category
        $productsCategory = $this->_categoryFactory->create()->getCollection()->addFieldToFilter('name', ['in'=>'products'])->addFieldToFilter('parent_id', ['in'=> $defaultcategoryId]);
        if ($collection->getSize()) {
            $productsCategoryId = $productsCategory->getFirstItem()->getId();
        } else {
            throw new CouldNotSaveException(__('There is not a category with the name products in the default category.'));
        } 

        // Trying to get the child id if exists
        try {
            $childId = $this->_netsuiteCategoryRepository->getByNetSuiteCategoryId($childCategoryNetsuiteId)->getCategoryId();
        }catch(\Exception $error){
            $childId = -1;
        }

        // If parent name exists
        if($parentCategoryNetsuiteId)
        {
            try {
                $parentId = $this->_netsuiteCategoryRepository->getByNetSuiteCategoryId($parentCategoryNetsuiteId)->getCategoryId();
            }catch(\Exception $error) {
                $parentId = -1;
            }
        }

        // If parent does not exist
        if($parentId === -1)
        {
            // Create and save category            
            $category = $this->_categoryFactory->create();
            if(!$parentName) {
                throw new CouldNotSaveException(__('There is not a name for the parent category.'));
            }

            $category->setName($parentName);
            $category->setMetaTitle($parentName);
            $category->setIsActive(true);
            $category->setParentId($productsCategoryId);
            $category->setStoreId(ItemManagementInterface::DEFAULT_STORE_ID);
            $result = $this->_categoryRepository->save($category);
            
            $netsuiteCategory = $this->_netsuiteCategoryFactory->create();
            $netsuiteCategory->setNetSuiteCategoryId($parentCategoryNetsuiteId);
            $netsuiteCategory->setCategoryId($result->getId());
            $this->_netsuiteCategoryRepository->save($netsuiteCategory);

            $parentId = $result->getId();
        }
    
        // If child does not exist
        if($childId === -1) {
            // Create and save category
            $category = $this->_categoryFactory->create();
            
            if(!$childName){
                throw new CouldNotSaveException(__('There is not a name for the child category.'));
            }
            $category->setName($childName);
            $category->setMetaTitle($childName);
            $category->setIsActive(true);
            $category->setStoreId(ItemManagementInterface::DEFAULT_STORE_ID);

            if($parentId === null){
                $category->setParentId($productsCategoryId);
            }else {
                $category->setParentId($parentId);
            }
            $result = $this->_categoryRepository->save($category);
            $netsuiteCategory = $this->_netsuiteCategoryFactory->create();
            $netsuiteCategory->setNetSuiteCategoryId($childCategoryNetsuiteId);
            $netsuiteCategory->setCategoryId($result->getId());
            $this->_netsuiteCategoryRepository->save($netsuiteCategory);
            
        } else { // If child exist
            // Get Category and change parent
            $category = $this->_categoryRepository->get($childId);
            $category->setStoreId(ItemManagementInterface::DEFAULT_STORE_ID);

            // Change parent?
            if($parentCategoryNetsuiteId === null){
                $category->move($productsCategoryId, null);
            }else if ($parentId != null && $parentId != $category->getParentCategory()->getId()){
                // url rewrite
                $urlRewriteCollection = $this->_urlRewrite->getCollection()->addFieldToFilter('entity_type', 'category')->addFieldToFilter('entity_id', $childId);
                $deleteItem = $urlRewriteCollection->getFirstItem(); 
                if ($urlRewriteCollection->getFirstItem()->getId()) {
                    // url exist
                    $deleteItem->delete();
                }
                $category->move($parentId, null);
            }

            // Change name?
            if($childName)
            {
                $category->setName($childName);
                $category->setMetaTitle($childName);

                // We need to use this method to save the name attribute
                $category->save();                
                $category->setUrlKey($childName);
            }
            $this->_categoryRepository->save($category);
        }
    }

    private function deleteEntities($entityList)
    {
        foreach ($entityList as $entity) 
        { 
            $this->logger->info('Category', ['return' => $entity]);
            $categoryName = $entity['parent'];
            if(is_string($categoryName))
            {
                $collection = $this->_categoryFactory->create()->getCollection()->addFieldToFilter('name', ['in'=> $categoryName]);
                if ($collection->getSize()) 
                {
                    $categoryId = $collection->getFirstItem()->getId();
                    $this->_categoryRepository->deleteByIdentifier($categoryId);
                }
            }
        }
    }
}
