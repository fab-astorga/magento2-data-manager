<?php

namespace Customers\Integration\Helper;

use Customers\Integration\Api\DataAuthInterface;

class Helper {

    public function __construct() { }

    /**
     * Create header for the request
     */
    public function setAuth($method)
    {
        $url = DataAuthInterface::RESTLET_URL; 

        $nonce = md5(mt_rand());
        $timestamp = time();
        $version = "1.0";
        $signatureMethod = "HMAC-SHA1";
        $realm = '560765_SB1';

        $base_string =
        $method."&" . urlencode(DataAuthInterface::RESTLET_URL) . "&" .
        urlencode(
            "deploy=" . DataAuthInterface::DEPLOY
          . "&oauth_consumer_key=" . DataAuthInterface::CONSUMER_KEY
          . "&oauth_nonce=" . $nonce
          . "&oauth_signature_method=" . $signatureMethod
          . "&oauth_timestamp=" . $timestamp
          . "&oauth_token=" . DataAuthInterface::TOKEN_ID
          . "&oauth_version=" . $version
          . "&script=" . DataAuthInterface::SCRIPT
        );
        $sig_string = urlencode(DataAuthInterface::CONSUMER_SECRET) . '&' . urlencode(DataAuthInterface::TOKEN_SECRET);
        $signature = base64_encode(hash_hmac("sha1", $base_string, $sig_string, true));
        
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
}