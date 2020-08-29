<?php

namespace Integration\Zippopotamus\Service;

class ZippopotamusIntegration implements \Integration\Zippopotamus\Api\ZippopotamusIntegrationInterface
{
    /**
     * GET
     * Retrieve the state information by zip code via Zippopotamus API
     * 
     * @param string $zipCode
     * @return string
     */
    public function sendStateRequest($zipCode)
    {
        $method = 'GET';
        $url = 'http://api.zippopotam.us/us/'.$zipCode;
        $headers = array (
            "Content-Type: application/json"
        );

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => $headers
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }
}