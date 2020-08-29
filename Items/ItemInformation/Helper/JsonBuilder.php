<?php

namespace Items\ItemInformation\Helper;

use Integration\Ups\Api\UpsDataAuthInterface;

class JsonBuilder
{
    public function __construct(
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Items\ItemInformation\Api\ShippingDetailsRepositoryInterface $shippingDetailsRepository,
        \Magento\Customer\Api\AddressRepositoryInterface $addressRepository,
        \Integration\Zippopotamus\Api\ZippopotamusIntegrationInterface $zippopotamusIntegration,
        \File\CustomLog\Logger\Logger $logger
		
	) {    
        $this->productRepository = $productRepository;
        $this->shippingDetailsRepository = $shippingDetailsRepository;
        $this->_addressRepository = $addressRepository;
        $this->_zippopotamusIntegration = $zippopotamusIntegration;
        $this->_logger = $logger;
    }

    /**
     * Build JSON in order to make a request to FedEx API through Postmen service
     * 
     * @param int $zipCode
     * @param int $requestedQuantity
     * @param int $productId
     * @return string
     */
    public function buildJsonUps($zipCode, $requestedQuantity, $productId)
    {
        $productDetails = $this->shippingDetailsRepository->getByProductId($productId);
        $packageWeight = $productDetails->getTotalCartonWeightLbs();
        $packageDimensions = explode('x',$productDetails->getCartonSize());
        $itemsPerPackage = $productDetails->getItemsPerCarton();

        // Verify the amount of packages that are necessaries for the request
        $qtyPackages = $requestedQuantity/$itemsPerPackage;
        if (is_float($qtyPackages)) {
            $qtyPackages = intval($qtyPackages) + 1;
        }

        try {
            $stateInfo = $this->_zippopotamusIntegration->sendStateRequest($zipCode);

        } catch (\Exception $e) {
            return false;
        }

        $stateJson = json_decode($stateInfo, true);
        $packageContainer = '{
                                "Dimensions": {
                                    "UnitOfMeasurement": {
                                        "Code": "IN"
                                            },
                                    "Length": "'.$packageDimensions[0].'",
                                    "Width": "'.$packageDimensions[1].'",
                                    "Height": "'.$packageDimensions[2].'"
                                        },
                                "PackageWeight": {
                                    "UnitOfMeasurement": {
                                        "Code": "LBS"
                                            },
                                    "Weight": "'.$packageWeight.'"
                                        },
                                "PackagingType": {
                                    "Code": "02"
                                        }
                            }';

        $jsonBefore = '{
            "RateRequest": {
                "CustomerClassification": {
                    "Code": "00"
                    },
                "Shipment": {
                    "Shipper": {
                        "Name": "Jennifer Gluck",
                        "ShipperNumber": "'.UpsDataAuthInterface::SHIPPER_NUMBER.'",
                        "Address": {
                        "AddressLine": "771 Indian Springs Road",
                        "City": "Indiana",
                        "StateProvinceCode": "PA",
                        "PostalCode": "15701",
                        "CountryCode": "US"
                            }
                        },
                    "ShipTo": {
                        "Name": "",
                        "Address": {
                        "AddressLine": "'.$stateJson['places'][0]['place name'].'",
                        "City": "'.$stateJson['places'][0]['state'].'",
                        "StateProvinceCode": "'.$stateJson['places'][0]['state abbreviation'].'",
                        "PostalCode": "'.$zipCode.'",
                        "CountryCode": "'.$stateJson['country abbreviation'].'"
                            }
                        },
                    "Package": [';

        $jsonAfter = '],
                            "ShipmentRatingOptions": {
                                "NegotiatedRatesIndicator": "",
                                "UserLevelDiscountIndicator": "TRUE"
                                },
                            "DeliveryTimeInformation": {
                                "Pickup": {
                                "Date": "20200630"
                                    }
                                }
                            }
                        }
                    }';

        $json = $jsonBefore;
        for ($i = 1; $i <= $qtyPackages; ++$i)
        {
            if($i == $qtyPackages) {
                $json = $json . $packageContainer;
            } else {
                $json = $json . $packageContainer . ',';
            }
        }
        $json = $json . $jsonAfter;

        $this->_logger->info('JSON TO SEND',['return'=>$json]);
        
        return $json;
    }
}