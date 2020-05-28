<?php
namespace Services\PmsColors\Model;

class PmsColorsManagement
{
    protected $_pantoneListCollection;

    public function __construct(
        \Services\PmsColors\Model\ResourceModel\PantoneList\CollectionFactory $pantoneListCollection
    ) 
    {
        $this->_pantoneListCollection  = $pantoneListCollection;
    }

    /**
     * {@inheritdoc}
     */
    public function getPmsColors()
    {
        $collection = $this->_pantoneListCollection->create();
        return $collection->getData();
    }
}