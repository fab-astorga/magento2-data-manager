<?php

namespace DistributorTools\FlyersEblasts\Model;

class FlyersEblastsManagement
{
    protected $_flyersEblastsCollection;
    protected $_pdfCreator;

    public function __construct(
        \DistributorTools\FlyersEblasts\Model\ResourceModel\FlyersEblasts\CollectionFactory $flyersEblastsCollection
    ) 
    {
        $this->_flyersEblastsCollection = $flyersEblastsCollection;
    }

    /**
     * {@inheritdoc}
     */
    public function getFlyersEblasts()
    {
        $collection = $this->_flyersEblastsCollection->create();
        return $collection->getData();
    }
}