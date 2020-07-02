<?php

namespace Customers\Integration\Service;

use Customers\Integration\Api\DataAuthInterface;

class Customer implements \Customers\Integration\Api\CustomerInterface
{
    protected $_helper;
    protected $_curlClient;  
    protected $_logger;

    public function __construct(
        \Customers\Integration\Helper\Helper $helper,
        \Magento\Framework\HTTP\Client\Curl $curl,
        \File\CustomLog\Logger\Logger $logger
    ) 
    {
        $this->_helper     = $helper;
        $this->_curlClient = $curl;
        $this->_logger     = $logger;
    }

    /**
     * @inheritdoc
     *
     */
    public function postCompanyRegistration($data)
    {  
        $serviceUrl = DataAuthInterface::RESTLET_URL.'?script='.DataAuthInterface::SCRIPT.'&deploy='.DataAuthInterface::DEPLOY;
        $auth_header = $this->_helper->setAuth('POST');

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $serviceUrl);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_FORCE_OBJECT));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, 
                        [
                            'Authorization: ' . $auth_header,
                            'Content-Type: application/json'
                        ]
            );

            $result = curl_exec($ch);
            $response = json_decode($result);
            curl_close($ch);            
            return $response;

        } catch(Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @inheritdoc
     *
     */
    public function deleteCompanyNetsuite($data)
    {
        $serviceUrl = DataAuthInterface::RESTLET_URL.'?script='.DataAuthInterface::SCRIPT.'&deploy='.DataAuthInterface::DEPLOY;
        $auth_header = $this->_helper->setAuth('POST');

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $serviceUrl);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_FORCE_OBJECT));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, 
                        [
                            'Authorization: ' . $auth_header,
                            'Content-Type: application/json'
                        ]
            );

            $result = curl_exec($ch);
            $response = json_decode($result, true);
            curl_close($ch);
            return $response;

        } catch(Exception $e) {
            return $e->getMessage();
        } 
    }
}