<?php

namespace Integration\Management\Helper;

use Integration\Management\Api\DataAuthInterface;

class Helper 
{
    protected $_logger;

    public function __construct(
        \File\CustomLog\Logger\Logger $logger
    ) 
    {
        $this->_logger = $logger;
    }
    /**
     * Create header for the Netsuite request
     * 
     * @param string $method
     * @param int $script
     * @param int $deploy
     * @param array|null $params
     * @return string
     */
    public function setAuth($method, $script, $deploy, $params)
    {
        $url = DataAuthInterface::RESTLET_URL; 

        $nonce = md5(mt_rand());
        $timestamp = time();
        $version = "1.0";
        $signatureMethod = "HMAC-SHA1";
        $realm = '560765_SB1';
        $signature = null;

        /* We have to build the signature with the parameters if not null (GET)*/
        if ($params != null) {
            $signature = $this->buildSignatureWithParams(
                                                            $method, 
                                                            $deploy, 
                                                            $params, 
                                                            $nonce,
                                                            $signatureMethod,
                                                            $timestamp, 
                                                            $version, 
                                                            $script
                                                        );
        } else {
            $base_string =  $method."&" . urlencode(DataAuthInterface::RESTLET_URL) . "&" .
                            urlencode(
                                "deploy=" . $deploy
                                . "&oauth_consumer_key=" . DataAuthInterface::CONSUMER_KEY
                                . "&oauth_nonce=" . $nonce
                                . "&oauth_signature_method=" . $signatureMethod
                                . "&oauth_timestamp=" . $timestamp
                                . "&oauth_token=" . DataAuthInterface::TOKEN_ID
                                . "&oauth_version=" . $version
                                . "&script=" . $script
                            );
            $sig_string = urlencode(DataAuthInterface::CONSUMER_SECRET) . '&' . urlencode(DataAuthInterface::TOKEN_SECRET);
            $signature = base64_encode(hash_hmac("sha1", $base_string, $sig_string, true));
        }
        
        $auth_header = "OAuth "
        . 'realm="' . rawurlencode($realm) .'",'
        . 'oauth_consumer_key="' . rawurlencode(DataAuthInterface::CONSUMER_KEY) . '",'
        . 'oauth_token="' . rawurlencode(DataAuthInterface::TOKEN_ID) . '",'  
        . 'oauth_signature_method="' . rawurlencode($signatureMethod) . '",'
        . 'oauth_timestamp="' . rawurlencode($timestamp) . '",'
        . 'oauth_nonce="' . rawurlencode($nonce) . '",'
        . 'oauth_version="' . rawurlencode($version) . '",'
        . 'oauth_signature="' . rawurlencode($signature) . '"';

        return $auth_header;
    }

    /**
     * Create signature for header when there are parameters
     * 
     * @param string $method
     * @param int $deploy
     * @param array $params
     * @param string $nonce
     * @param string $signatureMethod
     * @param string $timestamp
     * @param string $version
     * @param int $script
     * @return string
     */
    public function buildSignatureWithParams($method, $deploy, $params, $nonce, $signatureMethod,
                                            $timestamp, $version, $script)
    {
        $tmpData = [
            "deploy"=>$deploy,
            "oauth_consumer_key"=>DataAuthInterface::CONSUMER_KEY,
            "oauth_nonce"=>$nonce,
            "oauth_signature_method"=>$signatureMethod,
            "oauth_timestamp"=>$timestamp,
            "oauth_token"=>DataAuthInterface::TOKEN_ID,
            "oauth_version"=>$version,
            "script"=>$script
        ];

        $data = $tmpData + $params;
        ksort($data);

        $strData = "";
        $isFirst = true;
        foreach ($data as $key => $value)
        {
            if($isFirst) {
                $strData = $key."=".$value; 
                $isFirst = false;
            } else {
                $strData .= "&".$key."=".$value;
            }
        }

        $base_string =  $method."&".urlencode(DataAuthInterface::RESTLET_URL)."&".urlencode($strData);
        $sig_string = urlencode(DataAuthInterface::CONSUMER_SECRET).'&'.urlencode(DataAuthInterface::TOKEN_SECRET);
        $signature = base64_encode(hash_hmac("sha1", $base_string, $sig_string, true));

        return $signature;
    }
}