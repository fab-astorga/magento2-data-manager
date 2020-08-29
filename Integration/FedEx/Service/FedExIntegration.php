<?php

namespace Integration\FedEx\Service;

use Integration\FedEx\Api\FedExDataAuthInterface;

class FedExIntegration implements \Integration\FedEx\Api\FedExIntegrationInterface
{
    /**
     * POST
     * Method to send data to FedEx and calculates all rates quotes
     * 
     * @param string $xmlFedExRequest
     * @return string
     */
    public function sendFedExRateRequest($xmlFedExRequest)
    {
        try {

            $curl = curl_init(FedExDataAuthInterface::URL);
            curl_setopt ($curl, CURLOPT_HTTPHEADER, 
                        [
                            "Content-Type: text/xml"
                        ]
            );
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $xmlFedExRequest);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            
            $result = curl_exec($curl);
            
            if(curl_errno($curl)) {
                throw new Exception(curl_error($curl));
            }
            
            curl_close($curl);    
            return $result;

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}