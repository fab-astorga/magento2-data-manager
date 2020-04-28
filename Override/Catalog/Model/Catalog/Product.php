<?php

namespace Override\Catalog\Model\Catalog;

class Product extends \Magento\Catalog\Model\Product
{
   public function getName()
   {
       return $this->_getData(self::NAME) . ' customized!';
   }

public function getSku()
   {
       return "Customized SKU";
   }
}