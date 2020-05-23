<?php
namespace Services\ProductVideos\Model;

use Magento\Framework\Exception\CouldNotSaveException;

class ProductVideosManagement
{
    const PV_FILE  = 'csv/product_videos.csv';
    const NAME     = 0;
    const IMG      = 1;
    const VIDEO    = 2;
    const ID       = 3;

    protected $_productVideosRepository;
    protected $_productVideosCollection;
    private $_helper;

    public function __construct(
        \Services\ProductVideos\Api\ProductVideosRepositoryInterface $productVideosRepository,
        \Services\ProductVideos\Model\ResourceModel\ProductVideos\CollectionFactory $productVideosCollection,
        \Services\PmsColors\Helper\Data $helper
    ) 
    {
        $this->_productVideosRepository = $productVideosRepository;
        $this->_productVideosCollection = $productVideosCollection;
        $this->_helper                  = $helper;
    }

    /**
     * {@inheritdoc}
     */
    public function importProductVideosFromCsv() 
    {
        try { 
            $this->_productVideosRepository->delete();            
            $productVideos = $this->_helper->parseCsvFile(self::PV_FILE);

            foreach ($productVideos as $productVideo) 
            { 
                $this->_productVideosRepository->save(
                    $productVideo[self::ID],
                    $productVideo[self::NAME],
                    $productVideo[self::IMG],
                    $productVideo[self::VIDEO]
                );
            }
            return true;

        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getProductVideos()
    {
        $collection = $this->_productVideosCollection->create();
        return $collection->getData();
    }
}