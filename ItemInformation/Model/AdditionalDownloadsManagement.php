<?php
namespace Items\ItemInformation\Model;

use Items\ItemInformation\Api\Data\AdditionalDownloadsInterface;

class AdditionalDownloadsManagement implements \Items\ItemInformation\Api\AdditionalDownloadsManagementInterface {
 
    protected $_additionalDownloadsFactory;
    protected $_additionalDownloadsRepository;

    public function __construct(
        \Items\ItemInformation\Model\AdditionalDownloadsFactory $additionalDownloadsFactory,
        \Items\ItemInformation\Api\AdditionalDownloadsRepositoryInterface $additionalDownloadsRepository
    ) 
    {
        $this->_additionalDownloadsFactory = $additionalDownloadsFactory;
        $this->_additionalDownloadsRepository = $additionalDownloadsRepository;
    }

    /**
     * Returns true if the safety details saved correctly.
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @param array $additionalDownloadsInformation
     * @return boolean
     */
    public function saveAdditionalDownloads($product, $additionalDownloadsInformation){
        $additionalDownloads;

        try {
            $additionalDownloads = $this->_additionalDownloadsRepository->getByProductId($product->getIdBySku($product->getSku()));
        } catch(\Exception $error){
            $additionalDownloads = $this->_additionalDownloadsFactory->create();
            $additionalDownloads->setItemId($product->getIdBySku($product->getSku()));
        }

        if (array_key_exists(AdditionalDownloadsInterface::DOWNLOADS_DOCUMENTS_LINK_1, $additionalDownloadsInformation)) {
            $additionalDownloads->setDownloadsDocumentsLink1((string)$additionalDownloadsInformation[AdditionalDownloadsInterface::DOWNLOADS_DOCUMENTS_LINK_1]);
        }

        if (array_key_exists(AdditionalDownloadsInterface::DOWNLOADS_DOCUMENTS_LINK_2, $additionalDownloadsInformation)) {
            $additionalDownloads->setDownloadsDocumentsLink2((string)$additionalDownloadsInformation[AdditionalDownloadsInterface::DOWNLOADS_DOCUMENTS_LINK_2]);
        }

        if (array_key_exists(AdditionalDownloadsInterface::DOWNLOADS_DOCUMENTS_LINK_3, $additionalDownloadsInformation)) {
            $additionalDownloads->setDownloadsDocumentsLink3((string)$additionalDownloadsInformation[AdditionalDownloadsInterface::DOWNLOADS_DOCUMENTS_LINK_3]);
        }

        if (array_key_exists(AdditionalDownloadsInterface::DOWNLOADS_DOCUMENTS_NAME_1, $additionalDownloadsInformation)) {
            $additionalDownloads->setDownloadsDocumentsName1((string)$additionalDownloadsInformation[AdditionalDownloadsInterface::DOWNLOADS_DOCUMENTS_NAME_1]);
        }

        if (array_key_exists(AdditionalDownloadsInterface::DOWNLOADS_DOCUMENTS_NAME_2, $additionalDownloadsInformation)) {
            $additionalDownloads->setDownloadsDocumentsName2((string)$additionalDownloadsInformation[AdditionalDownloadsInterface::DOWNLOADS_DOCUMENTS_NAME_2]);
        }

        if (array_key_exists(AdditionalDownloadsInterface::DOWNLOADS_DOCUMENTS_NAME_3, $additionalDownloadsInformation)) {
            $additionalDownloads->setDownloadsDocumentsName3((string)$additionalDownloadsInformation[AdditionalDownloadsInterface::DOWNLOADS_DOCUMENTS_NAME_3]);
        }

        if (array_key_exists(AdditionalDownloadsInterface::DOWNLOAD_IMAGE_1, $additionalDownloadsInformation)) {
            $additionalDownloads->setDownloadImage1((string)$additionalDownloadsInformation[AdditionalDownloadsInterface::DOWNLOAD_IMAGE_1]);
        }

        if (array_key_exists(AdditionalDownloadsInterface::DOWNLOAD_IMAGE_2, $additionalDownloadsInformation)) {
            $additionalDownloads->setDownloadImage2((string)$additionalDownloadsInformation[AdditionalDownloadsInterface::DOWNLOAD_IMAGE_2]);
        }

        if (array_key_exists(AdditionalDownloadsInterface::DOWNLOAD_IMAGE_3, $additionalDownloadsInformation)) {
            $additionalDownloads->setDownloadImage3((string)$additionalDownloadsInformation[AdditionalDownloadsInterface::DOWNLOAD_IMAGE_3]);
        }

        if (array_key_exists(AdditionalDownloadsInterface::DOWNLOAD_IMAGE_4, $additionalDownloadsInformation)) {
            $additionalDownloads->setDownloadImage4((string)$additionalDownloadsInformation[AdditionalDownloadsInterface::DOWNLOAD_IMAGE_4]);
        }

        if (array_key_exists(AdditionalDownloadsInterface::DOWNLOAD_IMAGE_5, $additionalDownloadsInformation)) {
            $additionalDownloads->setDownloadImage5((string)$additionalDownloadsInformation[AdditionalDownloadsInterface::DOWNLOAD_IMAGE_5]);
        }

        if (array_key_exists(AdditionalDownloadsInterface::DOWNLOAD_IMAGE_6, $additionalDownloadsInformation)) {
            $additionalDownloads->setDownloadImage6((string)$additionalDownloadsInformation[AdditionalDownloadsInterface::DOWNLOAD_IMAGE_6]);
        }

        if (array_key_exists(AdditionalDownloadsInterface::DOWNLOAD_IMAGE_7, $additionalDownloadsInformation)) {
            $additionalDownloads->setDownloadImage7((string)$additionalDownloadsInformation[AdditionalDownloadsInterface::DOWNLOAD_IMAGE_7]);
        }

        if (array_key_exists(AdditionalDownloadsInterface::DOWNLOAD_IMAGE_8, $additionalDownloadsInformation)) {
            $additionalDownloads->setDownloadImage8((string)$additionalDownloadsInformation[AdditionalDownloadsInterface::DOWNLOAD_IMAGE_8]);
        }

        if (array_key_exists(AdditionalDownloadsInterface::DOWNLOAD_IMAGE_NAME_1, $additionalDownloadsInformation)) {
            $additionalDownloads->setDownloadImageName1((string)$additionalDownloadsInformation[AdditionalDownloadsInterface::DOWNLOAD_IMAGE_NAME_1]);
        }

        if (array_key_exists(AdditionalDownloadsInterface::DOWNLOAD_IMAGE_NAME_2, $additionalDownloadsInformation)) {
            $additionalDownloads->setDownloadImageName2((string)$additionalDownloadsInformation[AdditionalDownloadsInterface::DOWNLOAD_IMAGE_NAME_2]);
        }

        if (array_key_exists(AdditionalDownloadsInterface::DOWNLOAD_IMAGE_NAME_3, $additionalDownloadsInformation)) {
            $additionalDownloads->setDownloadImageName3((string)$additionalDownloadsInformation[AdditionalDownloadsInterface::DOWNLOAD_IMAGE_NAME_3]);
        }

        if (array_key_exists(AdditionalDownloadsInterface::DOWNLOAD_IMAGE_NAME_4, $additionalDownloadsInformation)) {
            $additionalDownloads->setDownloadImageName4((string)$additionalDownloadsInformation[AdditionalDownloadsInterface::DOWNLOAD_IMAGE_NAME_4]);
        }

        if (array_key_exists(AdditionalDownloadsInterface::DOWNLOAD_IMAGE_NAME_5, $additionalDownloadsInformation)) {
            $additionalDownloads->setDownloadImageName5((string)$additionalDownloadsInformation[AdditionalDownloadsInterface::DOWNLOAD_IMAGE_NAME_5]);
        }

        if (array_key_exists(AdditionalDownloadsInterface::DOWNLOAD_IMAGE_NAME_6, $additionalDownloadsInformation)) {
            $additionalDownloads->setDownloadImageName6((string)$additionalDownloadsInformation[AdditionalDownloadsInterface::DOWNLOAD_IMAGE_NAME_6]);
        }

        if (array_key_exists(AdditionalDownloadsInterface::DOWNLOAD_IMAGE_NAME_7, $additionalDownloadsInformation)) {
            $additionalDownloads->setDownloadImageName7((string)$additionalDownloadsInformation[AdditionalDownloadsInterface::DOWNLOAD_IMAGE_NAME_7]);
        }

        if (array_key_exists(AdditionalDownloadsInterface::DOWNLOAD_IMAGE_NAME_8, $additionalDownloadsInformation)) {
            $additionalDownloads->setDownloadImageName8((string)$additionalDownloadsInformation[AdditionalDownloadsInterface::DOWNLOAD_IMAGE_NAME_8]);
        }


        $this->_additionalDownloadsRepository->save($additionalDownloads);

        return true;
    }

}