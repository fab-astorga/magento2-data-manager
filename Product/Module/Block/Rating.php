<?php
namespace Product\Module\Block;
class Rating extends \Magento\Catalog\Block\Product\View
{
	protected $productFactory;
	protected $dataObjectHelper;
    protected $productRepository;
    protected $_logger;
    protected $_productReviewsManagementInterface;
    protected $_categoryFactory;
    protected $_itemManagement;
	
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
        \Magento\Framework\Api\DataObjectHelper $dataObjectHelper,
        \File\CustomLog\Logger\Logger $logger,
        \Reviews\Product\Api\ProductReviewsManagementInterface $productReviewsManagementInterface,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        \Items\ItemInformation\Api\ItemManagementInterface $itemManagement
	){
		parent::__construct($context, $urlEncoder, $jsonEncoder, $string, $productHelper, $productTypeConfig, $localeFormat, $customerSession, $productRepository, $priceCurrency, $data);
		$this->productFactory = $productFactory;      
		$this->productRepository = $productRepository;        
        $this->dataObjectHelper = $dataObjectHelper;
        $this->_logger = $logger;
        $this->_productReviewsManagementInterface = $productReviewsManagementInterface;
        $this->_categoryFactory = $categoryFactory;
        $this->_itemManagement = $itemManagement;
    }    
    
    public function createProductReview($score)
    {
        $product = $this->getProduct();
        $id = $product->getId();

        $this->_logger->info( 'bool2: '. $score  );
        
        //0<score<6

        $result = $this->_productReviewsManagementInterface->createProductReview($id,$score);
		return $result;
    }
    public function getProductAmountReviews()
    {
        $product = $this->getProduct();
        $id = $product->getId();

        $result = $this->_productReviewsManagementInterface->getProductAmountReviews($id);

		return $result;
    }
    public function getProductRating()
    {
        $product = $this->getProduct();
        $id = $product->getId();
        
        $result = $this->_productReviewsManagementInterface->getProductRating($id);
        $this->_logger->info( 'rating: '. $result );
		return $result;
    }

    public function getBestSellers()
    {
        $result = $this->_productReviewsManagementInterface->getBestSellers();

        foreach ($result as $key) {
            $this->_logger->info( 'best seller: '. $key["product"]->getId()  );
        }

		return $result;
    }

    public function getPrices()
    {
        $product = $this->getProduct();
        $id = $product->getId();
		$shippingDetail = $this->getProduct()->getExtensionAttributes()->getPrices();
		$priceArray = end($shippingDetail);
		$price = $priceArray["unit_price"];
		$array=[];
		$this->_logger->info( 'price: '. $price);
		return $price;
	}

    public function getCategory()
    {
        $collection= $this->_categoryFactory->create()->getCollection()->addFieldToFilter('name', ['in'=> 'New']);
        
        $onSaleCategoryId;
        if ($collection->getSize()) {
            $onSaleCategoryId = $collection->getFirstItem()->getId();
            $currentCategoriesIds[] = $onSaleCategoryId;
        }else {
            throw new CouldNotSaveException(__('There is not a category with the name: New.'));
        }
        $category = $this->_categoryFactory->create()->load($onSaleCategoryId);
        return $category;
    }

    public function getProductCollection()
    {
        return $this->getCategory()->getProductCollection()->addAttributeToSelect('*'); 
    }

    public function getEstimateShipping($zip, $qty)
    {
        $product = $this->getProduct();
        $id = $product->getId();
        return $this->_itemManagement->estimateShipping($zip, $qty, $id);
    }

    public function getCheckInventory($quantity)
    {
        $product = $this->getProduct();
        $id = $product->getId();
        return $this->_itemManagement->checkInventory($id, $quantity);
    }
}