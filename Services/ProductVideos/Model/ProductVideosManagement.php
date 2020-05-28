<?php
namespace Services\ProductVideos\Model;

class ProductVideosManagement
{
    protected $_productVideosCollection;

    public function __construct(
        \Services\ProductVideos\Model\ResourceModel\ProductVideos\CollectionFactory $productVideosCollection
    ) 
    {
        $this->_productVideosCollection = $productVideosCollection;
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