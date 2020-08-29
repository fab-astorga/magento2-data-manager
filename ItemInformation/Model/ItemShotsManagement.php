<?php
namespace Items\ItemInformation\Model;

use Items\ItemInformation\Api\Data\ItemMainShotsInterface;
use Items\ItemInformation\Api\Data\ItemMatrixShotsInterface;

use Magento\Framework\Filesystem\Driver\File;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;

class ItemShotsManagement implements \Items\ItemInformation\Api\ItemShotsManagementInterface 
{ 
    protected $_itemMainShotsFactory;
    protected $_itemMainShotsRepository;
    protected $_itemMatrixShotsFactory;
    protected $_itemMatrixShotsRepository;
    protected $_productRepository;
    protected $_importImageService;
    protected $_productGallery;
    protected $_imageProcessor;
    protected $_filesystem;
    protected $_file;
    protected $_colorSwatch;
    protected $_logger;

    public function __construct(
        \Items\ItemInformation\Model\ItemMainShotsFactory $itemMainShotsFactory,
        \Items\ItemInformation\Api\ItemMainShotsRepositoryInterface $itemMainShotsRepository,
        \Items\ItemInformation\Model\ItemMatrixShotsFactory $itemMatrixShotsFactory,
        \Items\ItemInformation\Api\ItemMatrixShotsRepositoryInterface $itemMatrixShotsRepository,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Items\ItemInformation\Service\ImportImageService $importImageService,
        \Magento\Catalog\Model\ResourceModel\Product\Gallery $productGallery,
        \Magento\Catalog\Model\Product\Gallery\Processor $imageProcessor,
        Filesystem $_filesystem,
        File $file,
        \Items\ItemInformation\Helper\ColorSwatch $colorSwatch,
        \Psr\Log\LoggerInterface $logger
    ) 
    {
        $this->_itemMainShotsFactory = $itemMainShotsFactory;
        $this->_itemMainShotsRepository = $itemMainShotsRepository;
        $this->_itemMatrixShotsFactory = $itemMatrixShotsFactory;
        $this->_itemMatrixShotsRepository = $itemMatrixShotsRepository;
        $this->_productRepository = $productRepository;
        $this->_importImageService = $importImageService;
        $this->_productGallery = $productGallery;
        $this->_imageProcessor = $imageProcessor;
        $this->_filesystem = $_filesystem;
        $this->_file = $file;
        $this->_colorSwatch = $colorSwatch;
        $this->_logger = $logger;
    }

    /**
     * Returns true if the item shots saved correctly.
     * 
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param array $itemMainShotsInformation
     * @param string $isConfigurableWithoutSimples
     * @return boolean
     */
    public function saveItemShots($product, $itemShotsInformation, $isConfigurableWithoutSimples)
    {
        $this->deletePreviousProductImages($product);

        $productType = $product->getTypeId();

        if($productType == 'configurable')
        {
            $mainShots = $itemShotsInformation[SELF::MAIN_SHOTS];
            $this->saveItemMainShots($product, $mainShots);
            $matrixShots = $itemShotsInformation[SELF::MATRIX_SHOTS];
            $this->saveItemMatrixShots($product, $matrixShots);
        }

        if($productType == 'simple')
        {
            if ($isConfigurableWithoutSimples == 'simple')
            {
                /* hacer verificaciones en main y matrix shots para este tipo de productos */
                $mainShots = $itemShotsInformation[SELF::MAIN_SHOTS];
                $this->saveItemMainShots($product, $mainShots);
            }

            $matrixShots = $itemShotsInformation[SELF::MATRIX_SHOTS];
            $this->saveItemMatrixShots($product, $matrixShots);
        }

        $this->_productRepository->save($product);
    }

    /**
     * Returns true if the item main shots saved correctly.
     * 
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param array $itemMainShotsInformation
     * @return boolean
     */
    public function saveItemMainShots($product, $itemMainShotsInformation)
    {
        $itemMainShots;

        try {
            $itemMainShots = $this->_itemMainShotsRepository->getByProductId($product->getIdBySku($product->getSku()));
        } catch(\Exception $error) {
            $itemMainShots = $this->_itemMainShotsFactory->create();
            $itemMainShots->setItemId($product->getIdBySku($product->getSku()));
        }

        if (array_key_exists(ItemMainShotsInterface::ITEM_GROUP_SHOT, $itemMainShotsInformation)) {
            $itemMainShots->setItemGroupShot((string)$itemMainShotsInformation[ItemMainShotsInterface::ITEM_GROUP_SHOT]);
        }

        if (array_key_exists(ItemMainShotsInterface::ITEM_GLAMOUR_SHOT, $itemMainShotsInformation)) {
            $itemMainShots->setItemGlamourShot((string)$itemMainShotsInformation[ItemMainShotsInterface::ITEM_GLAMOUR_SHOT]);
        }

        if (array_key_exists(ItemMainShotsInterface::GLAMOUR_SHOT_ALT_1, $itemMainShotsInformation)) {
            $itemMainShots->setGlamourShotAlt1((string)$itemMainShotsInformation[ItemMainShotsInterface::GLAMOUR_SHOT_ALT_1]);
        }

        if (array_key_exists(ItemMainShotsInterface::GROUP_SHOT_ALT_1, $itemMainShotsInformation)) {
            $itemMainShots->setGroupShotAlt1((string)$itemMainShotsInformation[ItemMainShotsInterface::GROUP_SHOT_ALT_1]);
        }

        if (array_key_exists(ItemMainShotsInterface::GROUP_SHOT_ALT_2, $itemMainShotsInformation)) {
            $itemMainShots->setGroupShotAlt2((string)$itemMainShotsInformation[ItemMainShotsInterface::GROUP_SHOT_ALT_2]);
        }

        if (array_key_exists(ItemMainShotsInterface::LID_1_SHOT, $itemMainShotsInformation)) {
            $itemMainShots->setLid1shot((string)$itemMainShotsInformation[ItemMainShotsInterface::LID_1_SHOT]);
        }

        if (array_key_exists(ItemMainShotsInterface::LID_2_SHOT, $itemMainShotsInformation)) {
            $itemMainShots->setLid2shot((string)$itemMainShotsInformation[ItemMainShotsInterface::LID_2_SHOT]);
        }

        if (array_key_exists(ItemMainShotsInterface::GIFT_BOX_ALT_1, $itemMainShotsInformation)) {
            $itemMainShots->setGiftBoxAlt1((string)$itemMainShotsInformation[ItemMainShotsInterface::GIFT_BOX_ALT_1]);
        }

        if (array_key_exists(ItemMainShotsInterface::GIFT_BOX_ALT_2, $itemMainShotsInformation)) {
            $itemMainShots->setGiftBoxAlt2((string)$itemMainShotsInformation[ItemMainShotsInterface::GIFT_BOX_ALT_2]);
        }

        $itemMainShots = $this->_itemMainShotsRepository->save($itemMainShots);

        $this->saveProductMainImages(
            $product, [
                $itemMainShots->getGiftBoxAlt2(),
                $itemMainShots->getGiftBoxAlt1(),
                $itemMainShots->getLid2shot(),
                $itemMainShots->getLid1shot(),
                $itemMainShots->getGroupShotAlt2(),
                $itemMainShots->getGroupShotAlt1(),
                $itemMainShots->getItemGroupShot(),
                $itemMainShots->getGlamourShotAlt1(),
                $itemMainShots->getItemGlamourShot(),
            ]);

        return true;
    }


    
    /**
     * Returns true if the item shots saved correctly.
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param array $itemShotsInformation
     * @return boolean
     */
    public function saveProductMainImages($product, $images)
    {
        $thereIsAnImage = false;

        // Add new images
        foreach($images as $imageUrl)
        {
            if($imageUrl != "" && $imageUrl != null)
            {
                $filePath = $this->_importImageService->execute($product, $imageUrl, false, ['small_image']);
                $fileRelativePath = "/../../temp".substr($filePath, strrpos($filePath, '/'));
                $fileRelativePathThumbnail = "/../..".substr($filePath, strrpos($filePath, '/'));
                $product->addAttributeUpdate('small_image', $fileRelativePath, 0);
                $product->addAttributeUpdate('image', $fileRelativePath, 0);
                $product->addAttributeUpdate('thumbnail', $fileRelativePathThumbnail, 0);
                $thereIsAnImage = true;
            }
        }

        if(!$thereIsAnImage)
        {
            $product->addAttributeUpdate('small_image', 'no_selection', 0);
            $product->addAttributeUpdate('image', 'no_selection', 0);
            $product->addAttributeUpdate('thumbnail', 'no_selection', 0);
        }
        
        return true;
    }

    /**
     * Returns true if the item shots saved correctly.
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param array $itemMatrixShotsInformation
     * @return boolean
     */
    public function saveItemMatrixShots($product, $itemMatrixShotsInformation)
    {
        $itemMatrixShots;

        try {
            $itemMatrixShots = $this->_itemMatrixShotsRepository->getByProductId($product->getIdBySku($product->getSku()));
        } catch(\Exception $error){
            $itemMatrixShots = $this->_itemMatrixShotsFactory->create();
            $itemMatrixShots->setItemId($product->getIdBySku($product->getSku()));
        }

        if (array_key_exists(ItemMatrixShotsInterface::WEB_STORE_COLOR_ORDER, $itemMatrixShotsInformation)) {
            $itemMatrixShots->setWebStoreColorOrder((int)$itemMatrixShotsInformation[ItemMatrixShotsInterface::WEB_STORE_COLOR_ORDER]);
        }

        if (array_key_exists(ItemMatrixShotsInterface::MATRIX_IMAGE, $itemMatrixShotsInformation)) {
            $itemMatrixShots->setMatrixImage((string)$itemMatrixShotsInformation[ItemMatrixShotsInterface::MATRIX_IMAGE]);
        }

        if (array_key_exists(ItemMatrixShotsInterface::ALTERNATE_IMAGE_1, $itemMatrixShotsInformation)) {
            $itemMatrixShots->setAlternateImage1((string)$itemMatrixShotsInformation[ItemMatrixShotsInterface::ALTERNATE_IMAGE_1]);
        }

        if (array_key_exists(ItemMatrixShotsInterface::ALTERNATE_IMAGE_2, $itemMatrixShotsInformation)) {
            $itemMatrixShots->setAlternateImage2((string)$itemMatrixShotsInformation[ItemMatrixShotsInterface::ALTERNATE_IMAGE_2]);
        }

        if (array_key_exists(ItemMatrixShotsInterface::ALTERNATE_IMAGE_3, $itemMatrixShotsInformation)) {
            $itemMatrixShots->setAlternateImage3((string)$itemMatrixShotsInformation[ItemMatrixShotsInterface::ALTERNATE_IMAGE_3]);
        }

        if (array_key_exists(ItemMatrixShotsInterface::ALTERNATE_IMAGE_4, $itemMatrixShotsInformation)) {
            $itemMatrixShots->setAlternateImage4((string)$itemMatrixShotsInformation[ItemMatrixShotsInterface::ALTERNATE_IMAGE_4]);
        }

        if (array_key_exists(ItemMatrixShotsInterface::BLANK_IMAGE_HIGH_RES, $itemMatrixShotsInformation)) {
            $itemMatrixShots->setBlankImageHighRes((string)$itemMatrixShotsInformation[ItemMatrixShotsInterface::BLANK_IMAGE_HIGH_RES]);
        }

        if (array_key_exists(ItemMatrixShotsInterface::LOGO_IMAGE_HIGH_RES, $itemMatrixShotsInformation)) {
            $itemMatrixShots->setLogoImageHighRes((string)$itemMatrixShotsInformation[ItemMatrixShotsInterface::LOGO_IMAGE_HIGH_RES]);
        }

        if (array_key_exists(ItemMatrixShotsInterface::NEW_COLOR_ADDED, $itemMatrixShotsInformation)) {
            $itemMatrixShots->setNewColorAdded((bool)$itemMatrixShotsInformation[ItemMatrixShotsInterface::NEW_COLOR_ADDED]);
        }

        if (array_key_exists(ItemMatrixShotsInterface::MATRIX_ITEM_OPTION_COLOR, $itemMatrixShotsInformation)) {
            $itemMatrixShots->setMatrixItemOptionColor((string)$itemMatrixShotsInformation[ItemMatrixShotsInterface::MATRIX_ITEM_OPTION_COLOR]);
            $this->_colorSwatch->saveOptionColor($product->getSku(), $itemMatrixShots->getMatrixItemOptionColor(), $product);
        }


        $itemMatrixShots = $this->_itemMatrixShotsRepository->save($itemMatrixShots);

        $this->saveProductMatrixImages(
            $product, [
                $itemMatrixShots->getLogoImageHighRes(),
                $itemMatrixShots->getBlankImageHighRes(),
                $itemMatrixShots->getAlternateImage4(),
                $itemMatrixShots->getAlternateImage3(),
                $itemMatrixShots->getAlternateImage2(),
                $itemMatrixShots->getAlternateImage1(),
                $itemMatrixShots->getMatrixImage()
            ]);

        return true;
    }


    /**
     * Returns true if the item shots saved correctly.
     *  
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param array $images
     * @return boolean
     */
    public function saveProductMatrixImages($product, $images)
    {
        $thereIsAnImage = false;
        // Add new images
        foreach($images as $imageUrl)
        {
            if($imageUrl != "" && $imageUrl != null)
            {
                $filePath = $this->_importImageService->execute($product, $imageUrl, false, ['thumbnail']);
                $fileRelativePath = "/../../temp".substr($filePath, strrpos($filePath, '/'));
                $fileRelativePathThumbnail = "/../..".substr($filePath, strrpos($filePath, '/'));
                $product->addAttributeUpdate('thumbnail', $fileRelativePathThumbnail, 0);
                $product->addAttributeUpdate('small_image', $fileRelativePath, 0);
                $product->addAttributeUpdate('swatch_image', $fileRelativePath, 0);
                $thereIsAnImage = true;
            }
        }

        if(!$thereIsAnImage)
        {
            $product->addAttributeUpdate('small_image', 'no_selection', 0);
            $product->addAttributeUpdate('swatch_image', 'no_selection', 0);
            $product->addAttributeUpdate('thumbnail', 'no_selection', 0);
        }
        return true;
    }


    /**
     * Returns true if the item images deleted correctly.
     * 
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param array $images
     * @return boolean
     */
    public function deletePreviousProductImages($product)
    {
        $existingMediaGalleryEntries = $product->getMediaGalleryEntries();

        if(is_array($existingMediaGalleryEntries)) 
        {
            foreach ($existingMediaGalleryEntries as $key => $entry) {
                unset($existingMediaGalleryEntries[$key]);
                $image = $entry->getFile();
                $this->_imageProcessor->removeImage($product, $image);

                if(file_exists($image)) {
                    unlink($image);
                }

                $fileName = $image;// replace this with some codes to get the $fileName
                $mediaRootDir = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath();

                if ($this->_file->isExists($mediaRootDir . $fileName)) 
                {
                    $this->_file->deleteFile($mediaRootDir . $fileName);
                }
            }
        }

        $product->setMediaGalleryEntries($existingMediaGalleryEntries);
        
        try {
            $product = $this->_productRepository->save($product);
        }catch(\Exception $e)
        {
            $message = array('type' => 'error', 'message' => 'Falied Delete Image Error: ' . $e->getMessage() . ' line ' . $e->getLine());
            $this->getLogger()->error(print_r($message, true));
        }
    }
}