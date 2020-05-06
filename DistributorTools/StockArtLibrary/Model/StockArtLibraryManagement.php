<?php
namespace DistributorTools\StockArtLibrary\Model;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\StateException;
use Magento\Framework\Exception\CouldNotDeleteException;

class StockArtLibraryManagement {

    // Incoming JSON fields mapping
    const STOCK_ART_COVER_ID = 'id';
    const STOCK_ART_NAME = 'name';
    const STOCK_ART_THUMBNAIL = 'thumbnail';
    const STOCK_ART_IMG = 'img';
    const STOCK_ART_COVER_ITEMS = 'presentationItems'; 
    const STOCK_ART_COVER_SINGLE_PRESENTATION_ITEM = 'presentationItem';
    const STOCK_ART_IMAGE_ID = 'id';  

    protected $_stockArtCoverRepository;
    protected $_stockArtImagesAttributeRepository;
    protected $_logger;

    public function __construct(
        \DistributorTools\StockArtLibrary\Api\StockArtCoverRepositoryInterface $stockArtCoverRepository,
        \DistributorTools\StockArtLibrary\Api\StockArtImagesAttributeRepositoryInterface $stockArtImagesAttributeRepository,
        \File\CustomLog\Logger\Logger $logger
    ) 
    {
        $this->_stockArtCoverRepository           = $stockArtCoverRepository;
        $this->_stockArtImagesAttributeRepository = $stockArtImagesAttributeRepository;
        $this->_logger                            = $logger;
    }

    /**
     * {@inheritdoc}
     * This method makes an update or save of Stock Art Library.
     */
    public function saveStockArtLibrary() 
    {
        try { 
            // Retrieve all data
            $data = (array) json_decode(file_get_contents('php://input'), true);
            $error_msg = $data['error'];

            // Check if data is error free
            if($error_msg) {
                throw new StateException(__('Request contains errors.'));
            }
        
            // Retrieve all data
            $stockArtLibraryData = $data['categories'];

            // extract each cover image and store it into the database
            foreach ($stockArtLibraryData as $stockArtCover) 
            {
                $this->_stockArtCoverRepository->save(
                            $stockArtCover[self::STOCK_ART_COVER_ID],
                            $stockArtCover[self::STOCK_ART_NAME],
                            $stockArtCover[self::STOCK_ART_THUMBNAIL],
                            $stockArtCover[self::STOCK_ART_IMG],
                );
                // extract presentation items from each cover image and store it into the database
                foreach ($stockArtCover[self::STOCK_ART_COVER_ITEMS] as $stockArtImage)
                {
                    $this->_stockArtImagesAttributeRepository->save(
                        $stockArtImage[self::STOCK_ART_IMAGE_ID],
                        $stockArtCover[self::STOCK_ART_COVER_ID], //ID for linking an image with its cover
                        $stockArtImage[self::STOCK_ART_NAME],
                        $stockArtImage[self::STOCK_ART_IMG]
                    );
                }
            }                
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e));
        }
    }

    public function saveCover() 
    {
        try { 
            // Retrieve cover data
            $stockArtCoverData = (array) json_decode(file_get_contents('php://input'), true);
      
            // extract cover data and store it into the database
            $this->_stockArtCoverRepository->save (
                        $stockArtCoverData[self::STOCK_ART_COVER_ID],
                        $stockArtCoverData[self::STOCK_ART_NAME],
                        $stockArtCoverData[self::STOCK_ART_THUMBNAIL],
                        $stockArtCoverData[self::STOCK_ART_IMG]
            );
            // extract presentation items from cover and store it into the database
            foreach ($stockArtCoverData[self::STOCK_ART_COVER_ITEMS] as $stockArtImage)
            {
                $this->_stockArtImagesAttributeRepository->save (
                    $stockArtImage[self::STOCK_ART_IMAGE_ID],
                    $stockArtCoverData[self::STOCK_ART_COVER_ID], //ID for linking an image with its cover
                    $stockArtImage[self::STOCK_ART_NAME],
                    $stockArtImage[self::STOCK_ART_IMG]
                );
            }

        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e));
        }
    }

    public function saveCoverImage() 
    {
        try { 
            // Retrieve cover image data
            $data = (array) json_decode(file_get_contents('php://input'), true);

            $stockArtCoverId = $data[self::STOCK_ART_COVER_ID];
            $stockArtCoverImage = $data[self::STOCK_ART_COVER_SINGLE_PRESENTATION_ITEM];
      
            // extract cover data and store it into the database
            $this->_stockArtImagesAttributeRepository->save (
                $stockArtCoverImage[self::STOCK_ART_IMAGE_ID],
                $stockArtCoverId,                               //ID for linking an image with its cover
                $stockArtCoverImage[self::STOCK_ART_NAME],
                $stockArtCoverImage[self::STOCK_ART_IMG]
            );

        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e));
        }
    }

    public function deleteCover() 
    {
        try { 
            // Retrieve cover id
            $data = (array) json_decode(file_get_contents('php://input'), true);
      
            // delete cover
            $this->_stockArtCoverRepository->deleteById($data['id']);

        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e));
        }
    }

    public function deleteCoverImage() 
    {
        try { 
            // Retrieve cover image id
            $data = (array) json_decode(file_get_contents('php://input'), true);
      
            // delete cover image
            $this->_stockArtImagesAttributeRepository->deleteById($data['id']);

        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e));
        }
    }
}