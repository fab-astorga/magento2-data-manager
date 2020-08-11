<?php

namespace Items\ItemInformation\Service;

use Magento\Catalog\Model\Product;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem\Io\File;

/**
 * Class ImportImageService
 * assign images to products by image URL
 */
class ImportImageService
{
    const PATH = "/opt/bitnami/magento/htdocs/app/design/frontend/Gs/gstheme/web/images/flyerEblast/";
    /**
     * Directory List
     *
     * @var DirectoryList
     */
    protected $directoryList;

    /**
     * File interface
     *
     * @var File
     */
    protected $file;

    /**
     * ImportImageService constructor
     *
     * @param DirectoryList $directoryList
     * @param File $file
     */
    public function __construct(
        DirectoryList $directoryList,
        File $file
    ) {
        $this->directoryList = $directoryList;
        $this->file = $file;
    }

    /**
     * Main service executor
     *
     * @param Product $product
     * @param string $imageUrl
     * @param array $imageType
     * @param bool $visible
     *
     * @return string
     */
    public function execute($product, $imageUrl, $visible = false, $imageType = [])
    {
        /** @var string $tmpDir */
        $tmpDir = $this->getMediaDirTmpDir();
        /** create folder if it is not exists */
        $this->file->checkAndCreateFolder($tmpDir);
        /** @var string $newFileName */
        $newFileName = $tmpDir . baseName($imageUrl);
        /** read file from URL and copy it to the new destination */
        $result = $this->file->read($imageUrl, $newFileName);

        
        /** @var string $tmpDir */
        $tmpDirThumbail = $this->getMediaDirTmpDirForThumbnail();
        /** create folder if it is not exists */
        $this->file->checkAndCreateFolder($tmpDirThumbail);
        /** @var string $newFileName */
        $newFileNameThumbnail = $tmpDirThumbail . baseName($imageUrl);
        /** read file from URL and copy it to the new destination */
        $this->file->read($imageUrl, $newFileNameThumbnail);

        if ($result) {
            /** add saved file to the $product gallery */
            $product->addImageToMediaGallery($newFileName, $imageType, false, $visible);
        }

        return $newFileName;
    }

    /**
     * Main service executor
     *
     * @param Product $product
     * @param string $imageUrl
     * @param array $imageType
     * @param bool $visible
     *
     * @return string
     */
    public function convertUrlToImg($imageUrl)
    {  
        /** @var string $tmpDir */
        $flyersEblastsPath = self::PATH;

        /** create folder if it is not exists */
        $this->file->checkAndCreateFolder($flyersEblastsPath);
        // /** @var string $newFileName */
        $path = substr($imageUrl, strrpos($imageUrl, '.'));
        $value = array("?", "&");
        $newFlyersEblastsName = "";
        if($path == ".jpg" || $path == ".png" || $path == ".jpeg"){
            $newFlyersEblastsName =  $flyersEblastsPath . str_replace($value,"",baseName($imageUrl));
            
        }else{
            $newFlyersEblastsName = $flyersEblastsPath .  str_replace($value,"",baseName($imageUrl)).".jpg";
        }
        /** read file from URL and copy it to the new destination */
        $result = $this->file->read($imageUrl, $newFlyersEblastsName);

        return $flyersEblastsPath;
    }

    /**
     * Media directory name for the temporary file storage
     * pub/media/tmp
     *
     * @return string
     */
    protected function getMediaDirTmpDir()
    {

        return $this->directoryList->getPath(DirectoryList::MEDIA) . DIRECTORY_SEPARATOR . 'catalog' . DIRECTORY_SEPARATOR . 'product' . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR .'tmp';
    }

    /**
     * We need add images in media directory if we want to use a thumnail image, this is due to bitnami limitations
     *
     * @return string
     */
    protected function getMediaDirTmpDirForThumbnail()
    {

        return $this->directoryList->getPath(DirectoryList::MEDIA) . DIRECTORY_SEPARATOR . 'tmp';
    }
}