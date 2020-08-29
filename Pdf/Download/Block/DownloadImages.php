<?php
namespace Pdf\Download\Block;
class DownloadImages extends \Magento\Catalog\Block\Product\View
{
	protected $productFactory;
	protected $dataObjectHelper;
	protected $productRepository;
	
	public function __construct(
		\Magento\Catalog\Block\Product\Context $context,
		\Magento\Framework\Url\EncoderInterface $urlEncoder,
		\Magento\Framework\Json\EncoderInterface $jsonEncoder,
		\Magento\Framework\Stdlib\StringUtils $string,
		\Magento\Catalog\Helper\Product $productHelper,
		\Magento\Catalog\Model\ProductTypes\ConfigInterface $productTypeConfig,
		\Magento\Framework\Locale\FormatInterface $localeFormat,
		\Magento\Customer\Model\Session $customerSession,
		\Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
		\Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
		array $data = [],
		\Magento\Catalog\Api\Data\ProductInterfaceFactory $productFactory, 
		\Magento\Framework\Api\DataObjectHelper $dataObjectHelper
		
	){
		parent::__construct($context, $urlEncoder, $jsonEncoder, $string, $productHelper, $productTypeConfig, $localeFormat, $customerSession, $productRepository, $priceCurrency, $data);
		$this->productFactory = $productFactory;      
		$this->productRepository = $productRepository;        
		$this->dataObjectHelper = $dataObjectHelper;
	}

	public function getProductId(){
		$product = $this->getProduct();
		$id = $product->getId();
		return $id;
	}
    
    public function getAllFiles(){
        $product = $this->getProduct();

		$file_arr=array();

		$id = $product->getId();

		if(!isset($product)){
			return;
		}

		if ($product->getTypeId() != \Magento\ConfigurableProduct\Model\Product\Type\Configurable::TYPE_CODE) {
			return [];
		}

		$storeId = $this->_storeManager->getStore()->getId();

		$productTypeInstance = $product->getTypeInstance();
		$productTypeInstance->setStoreFilter($storeId, $product);
		$usedProducts = $productTypeInstance->getUsedProducts($product);
		$childrenList = [];       

		foreach ($product->getMediaGalleryImages() as $image) :
			array_push($file_arr, (string) '/opt/bitnami/magento/htdocs/pub/media/catalog/product'.$image->getFile());
		endforeach;

		foreach ($usedProducts  as $child) {
			foreach ($child->getMediaGalleryImages() as $image) :
				array_push($file_arr, (string) '/opt/bitnami/magento/htdocs/pub/media/catalog/product'.$image->getFile());
			endforeach;
		}

		return $file_arr;
    }
    
    function create_zip($files = array())
    {
	/*	$zip = new \ZipArchive();
		$res = $zip->open('product-images.zip',  (\ZipArchive::CREATE | \ZipArchive::OVERWRITE) );
        if ($res === TRUE) {
            foreach ($files as $file) {
                $download_file = file_get_contents($file);
                $zip->addFromString(basename($file), $download_file);
            }
            $zip->close();
        }*/
	}        
}