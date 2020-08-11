<?php

namespace Items\ItemInformation\Setup\Patch\Data;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class AddOnSaleNewClearanceAttributes implements DataPatchInterface
{
   /** @var ModuleDataSetupInterface */
   private $moduleDataSetup;

   /** @var EavSetupFactory */
   private $eavSetupFactory;

   /**
    * @param ModuleDataSetupInterface $moduleDataSetup
    * @param EavSetupFactory $eavSetupFactory
    */
   public function __construct(
       ModuleDataSetupInterface $moduleDataSetup,
       EavSetupFactory $eavSetupFactory
   ) {
       $this->moduleDataSetup = $moduleDataSetup;
       $this->eavSetupFactory = $eavSetupFactory;
   }

   /**
    * {@inheritdoc}
    */
   public function apply()
   {
       /** @var EavSetup $eavSetup */
       $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

     //  $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'on_sale');
     //  $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'new');
     //  $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'clearance');

       $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'on_sale', [
        'group' =>  'Default',
        'type' => 'int',
        'label' => 'On Sale',
        'input' => 'select',
        'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
        'visible' => true,
        'required' => false,
        'user_defined' => true,
        'default' => null,
        'searchable' => true,
        'filterable' => true,
        'comparable' => false,
        'visible_on_front' => false,
        'used_in_product_listing' => true,
        'unique' => false,
    ]);

    $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'new', [
        'group' =>  'Default',
        'type' => 'int',
        'label' => 'New',
        'input' => 'select',
        'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
        'visible' => true,
        'required' => false,
        'user_defined' => true,
        'default' => null,
        'searchable' => true,
        'filterable' => true,
        'comparable' => false,
        'visible_on_front' => false,
        'used_in_product_listing' => true,
        'unique' => false,
    ]);

    $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'clearance', [
        'group' =>  'Default',
        'type' => 'int',
        'label' => 'Clearance',
        'input' => 'select',
        'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
        'visible' => true,
        'required' => false,
        'user_defined' => true,
        'default' => null,
        'searchable' => true,
        'filterable' => true,
        'comparable' => false,
        'visible_on_front' => false,
        'used_in_product_listing' => true,
        'unique' => false,
    ]);
}

   /**
    * {@inheritdoc}
    */
   public static function getDependencies()
   {
       return [];
   }

   /**
    * {@inheritdoc}
    */
   public function getAliases()
   {
       return [];
   }
}