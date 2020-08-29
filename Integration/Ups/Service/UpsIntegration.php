<?php

namespace Integration\Ups\Service;

use Integration\Ups\Api\UpsDataAuthInterface;

class UpsIntegration implements \Integration\Ups\Api\UpsIntegrationInterface
{
    /**
     * POST
     * Method to send data to UPS and calculates all rates quotes
     * 
     * @param string $jsonUpsRequest
     * @return string
     */
    public function sendUpsRateRequest($jsonUpsRequest)
    {
        $method = 'POST';
        $headers = array (
            "Content-Type: application/json",
            "AccessLicenseNumber: ".UpsDataAuthInterface::ACCESS_LICENSE_NUMBER,
            "Username: ".UpsDataAuthInterface::USERNAME,
            "Password: ".UpsDataAuthInterface::PASSWORD
        );

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => UpsDataAuthInterface::URL,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POSTFIELDS => $jsonUpsRequest
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