<?php
namespace Items\ItemInformation\Block\Product;

class View extends \Magento\Catalog\Block\Product\View
{	
	protected $productFactory;
	protected $dataObjectHelper;
	protected $productRepository;
	protected $emailHelper;
	
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
		\Items\ItemInformation\Helper\Email $emailHelper
		
	){
		parent::__construct($context, $urlEncoder, $jsonEncoder, $string, $productHelper, $productTypeConfig, $localeFormat, $customerSession, $productRepository, $priceCurrency, $data);
		$this->productFactory = $productFactory;      
		$this->productRepository = $productRepository;        
		$this->dataObjectHelper = $dataObjectHelper;
		$this->emailHelper = $emailHelper;
	}	

	public function sendEmail($qty)
	{
		$product = $this->getProduct();
		$sku = $product->getSku();
		
		$response = $this->emailHelper->sendSpecialQuoteEmail($qty, $sku);
		return $response;
	}
	
	public function getItemDetails(){
		
		$itemDetails = $this->getProduct()->getExtensionAttributes()->getItemDetails();
		$array = array(
			'Sales Description' => $itemDetails->getSalesDescription(),
			'Item PMS Color' => $itemDetails->getItemPMSColor(),
			'Item Volume In Oz' => $itemDetails->getItemVolumeInOz(),
			'Packaging' => $itemDetails->getPackaging(),
			'Item Material' => $itemDetails->getItemMaterial(),
			'Item Gusset' => $itemDetails->getItemGusset(),
			'Item Handle Length' => $itemDetails->getItemHandleLength(),
			'Item Depth' => $itemDetails->getItemDepth(),
			'Item Width' => $itemDetails->getItemWidth(),
			'Item Height' => $itemDetails->getItemHeight(),
			'Item Top Diameter' => $itemDetails->getItemTopDiameter(),
			'Item Bottom Diameter' => $itemDetails->getItemBottomDiameter(),
			'Item Length' => $itemDetails->getItemLength(),
			'Item Diameter' => $itemDetails->getItemDiameter(),
			'Fits Car Cup Holder' => $itemDetails->getFitsCarCupHolder(),
			'Microwave Safe' => $itemDetails->getMicrowaveSafe(),
			'Top Rack Dishwasher Safe' => $itemDetails->getTopRackDishwasherSafe(),
			'Carabiner Included' => $itemDetails->getCarabinerIncluded(),
			'Spill Proof' => $itemDetails->getSpillProof(),
			'Spill Persistant' => $itemDetails->getSpillPersistant(),
			'Handwash Only' => $itemDetails->getHandwashOnly(),
			'Patent Number' => $itemDetails->getPatentNumber(),
			'Recycle Number' => $itemDetails->getRecycleNumber(),
			'MAH' => $itemDetails->getMAH(),
			'Batteries Included' => $itemDetails->getBatteriesIncluded()

		);

		return $array;
	}
	
	public function getShippingDetails(){
		
		$shippingDetail = $this->getProduct()->getExtensionAttributes()->getShippingDetails();
		$array = array(
			'Individual Item Weight Oz' => $shippingDetail->getIndividualItemWeightOz(),
			'Gift Box Weigh tOz' => $shippingDetail->getGiftBoxWeightOz(),
			'Total Item Weight' => $shippingDetail->getTotalItemWeight(),
			'Total Item Weigh tUnit' => $shippingDetail->getTotalItemWeightUnit(),
			'Items Per Carton' => $shippingDetail->getItemsPerCarton(),
			'Gift Box Color' => $shippingDetail->getGiftBoxColor(),
			'Package' => $shippingDetail->getPackage(),
			'Carton Size' => $shippingDetail->getCartonSize(),
			'Carton Weight Oz' => $shippingDetail->getCartonWeightOz(),
			'Total Carton Weight Lbs' => $shippingDetail->getTotalCartonWeightLbs(),
			'Shipping Data Verified' => $shippingDetail->getShippingDataVerified(),
			'Total Cartons Per Pallet' => $shippingDetail->getTotalCartonsPerPallet(),
			'Pack Out Quantityt' => $shippingDetail->getPackOutQuantity(),
			'Ice Pack Required' => $shippingDetail->getIcePackRequired()
		);

		return $array;
	}

	public function getSafetyDetails(){
		
		$shippingDetail = $this->getProduct()->getExtensionAttributes()->getSafetyDetails();
		$array = array(
			'Safety Details Name' => $shippingDetail->getSafetyDetailsName(),
			'Safety Details Link' => $shippingDetail->getSafetyDetailsLink(),
			'Safety Details Name Two' => $shippingDetail->getSafetyDetailsNameTwo(),
			'Safety Details Link Two' => $shippingDetail->getSafetyDetailsLinkTwo(),
			'Safety Details Name Three' => $shippingDetail->getSafetyDetailsNameThree(),
			'Safety Details Link Three' => $shippingDetail->getSafetyDetailsLinkThree(),
			'Safety Test Link' => $shippingDetail->getSafetyTestLink(),
			'Fda Test Link' => $shippingDetail->getFdaTestLink(),
			'Safety Test Date' => $shippingDetail->getSafetyTestDate(),
			'Prop 65 Warning' => $shippingDetail->getProp65Warning(),
			'Safety Test Available' => $shippingDetail->getSafetyTestAvailable()
		);

		return $array;
	}

	public function getPrices(){
		
		$shippingDetail = $this->getProduct()->getExtensionAttributes()->getPrices();
		$array=[];

			for ($i=0; $i < count($shippingDetail); $i++) { 
				array_push($array, $shippingDetail[$i]);
			}
		return $array;
	}	
	
}