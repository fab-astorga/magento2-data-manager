<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Items\ItemInformation\Helper;

use Items\ItemInformation\Api\Data\PricesInterface;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\EntityManager\MetadataPool;


/**
 * Class Helper Data
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */

/** 
* This class makes a managemento of color swatches
* Copyright © Midware
*/
class ColorSwatch
{
    // Color Swatch Table
    const SWATCH_OPTION_TABLE = 'eav_attribute_option_swatch';

    /**
     * @var \Magento\Framework\App\ResourceConnection
     */

    protected $_resourceConnection;
    protected $_eavSetupFactory;
    protected $_eavAttribute;
    protected $_storeManager;
    protected $_imageService;
    protected $_logger;
    protected $_swatchHelper;

    public function __construct(
        ResourceConnection $resourceConnection,
        \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory,
        \Magento\Eav\Model\Entity\AttributeFactory $eavAttribute,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Items\ItemInformation\Service\ImportImageService $imageService,
        \File\CustomLog\Logger\Logger $logger,
        \Magento\Swatches\Helper\Data $swatchHelper
    ) {
        $this->_resourceConnection = $resourceConnection;
        $this->_eavSetupFactory    = $eavSetupFactory;
        $this->_eavAttribute       = $eavAttribute;
        $this->_storeManager       = $storeManager;
        $this->_imageService       = $imageService;
        $this->_logger             = $logger;   
        $this->_swatchHelper        = $swatchHelper;
    }   


    /**
     * @param string $value
     * @return array
     */
    public function getOptionIdByValue($value)
    {
        $connection = $this->_resourceConnection->getConnection();

        $select = $connection->select()->from(
            'eav_attribute_option_value',
            ['option_id']
        )->where(
            'value = ?',
            (string) $value
        );

        return $connection->fetchCol($select);
    }


    /**
     * @param string $name
     * @param string $value
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @return array
     */
    public function saveOptionColor(string $name, string $value, $product)
    {
        $optionId;
        $finalValue;
        $type; // 1 - color, 2 - image

        if(!$value){
            $type = 1;
            $finalValue = "#ffffff";
        }
        else if($value[0] === '#'){
            $type = 1;
            $finalValue = $value;
        } else {
            // Retrieve the image file and path
            try {
                $filePath = $this->_imageService->execute($product, $value, true, ['thumbnail']);
                $fileRelativePath = "/../..".substr($filePath, strrpos($filePath, '/'));
                $finalValue = $fileRelativePath;
                $type = 2;
            } catch(\Error $error) {
                $type = 1;
                $finalValue = "#ffffff";
            }
        }

        $connection = $this->_resourceConnection->getConnection();

        try {
            $optionId = $this->getOptionIdByValue($name)[0]; 
            if(!$optionId){
                $this->createColorSwatch($name); 
            }
    
            // Delete actual option swatch if exist
            $condition = ['option_id = ?' => (int) $optionId];
            $connection->delete($this->getSwatchTable(), $condition);
    
    
            // Create a new row on eav_attribute_option_swatch
            if ($name && $finalValue) 
            {
                $data = [];
                $data[] = [
                    'option_id' => (int) $optionId,
                    'store_id' => (int) 0,
                    'type' => (int) $type,
                    'value' => (string) $finalValue
                ];
                $connection->insertMultiple($this->getSwatchTable(), $data);
            }
    
            // We try to set the color option to their custom attribute
            try {
                $product->addAttributeUpdate('color', $optionId, 0);
                $product->setCustomAttribute('color', $optionId); 
            } catch(\Error $error) {
                $product->setCustomAttribute('color', $optionId);
            }
            
        } catch(\Exception $e) {
            
        } 

        return true;
    }

    public function createColorSwatch($name)
    {
        // Retrieve the attribute id by code
        $attributeId = $this->_eavAttribute->create()->load('color','attribute_code');

        // Create the option
        $option = [$name => $name];
        $allStores = $this->_storeManager->getStores();
        $option['attribute_id'] = $attributeId->getAttributeId();

        $this->_logger->info('OPTION ATTRIBUTE ID: ' . $option['attribute_id']);

      //  $hashCode = $this->getAtributeSwatchHashcode( 50 );
      //  $this->_logger->info('HASH CODE: ' . $hashCode);

        foreach($option as $key=>$value) 
        {
            $option['value'][$value][0] = $value;
            $this->_logger->info('OPTION VALUE: ' . $option['value'][$value][0]);

            foreach($allStores as $store) {
                $option['value'][$value][$store->getId()] = $value;
                $this->_logger->info('STORES VALUES: ' . $option['value'][$value][$store->getId()] );
            }
        }

        // Save the option
        $eavSetup = $this->_eavSetupFactory->create();
        $eavSetup->addAttributeOption($option);
    }

    /**
     * @return string
     */
    private function getSwatchTable()
    {
        return SELF::SWATCH_OPTION_TABLE;
    }

    /**
     * Get Hashcode of Visual swatch by option id
     * 
     * @return string
     */
    public function getAtributeSwatchHashcode($optionid) 
    {
        $hashcodeData = $this->_swatchHelper->getSwatchesByOptionsId([$optionid]);
        return $hashcodeData[$optionid]['value'];
    }
}