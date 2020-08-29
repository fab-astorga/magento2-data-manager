<?php

namespace Integration\Netsuite\Service;

use Integration\Netsuite\Api\DataAuthInterface;

class Integration implements \Integration\Netsuite\Api\IntegrationInterface
{
    protected $_helper;
    protected $_logger;

    public function __construct(
        \Integration\Netsuite\Helper\Helper $helper,
        \File\CustomLog\Logger\Logger $logger
    
    ) 
    {
        $this->_helper = $helper;
        $this->_logger = $logger;
    }

    /**
     * @inheritdoc
     *
     */
    public function sendNetsuiteRequest($data, $method, $script, $deploy)
    {  
        $serviceUrl = DataAuthInterface::RESTLET_URL.'?script='.$script.'&deploy='.$deploy;
        $authHeader = $this->_helper->setAuth($method, $script, $deploy, null);

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $serviceUrl);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_FORCE_OBJECT));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER,
                        [
                            'Authorization: ' . $authHeader,
                            'Content-Type: application/json'
                        ]
            );

            $result = curl_exec($ch);

            if(curl_errno($ch)) {
                throw new Exception(curl_error($ch));
            }

            $response = json_decode($result, true);
            curl_close($ch);            
            return $response;

        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @inheritdoc
     *
     */
    public function getNetsuiteResponse($url, $method, $script, $deploy, $params)
    {
        $authHeader = $this->_helper->setAuth($method, $script, $deploy, $params);

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER,
                        [
                            'Authorization: ' . $authHeader,
                            'Content-Type: application/json'
                        ]
            );
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $result = curl_exec($ch);

            if(curl_errno($ch)) {
                throw new Exception(curl_error($ch));
            }

            $response = json_decode($result, true);
            curl_close($ch);            
            return $response;

        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }
}