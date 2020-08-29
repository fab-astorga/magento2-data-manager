<?php

namespace Integration\FedEx\Api;

interface FedExIntegrationInterface 
{
    /**
     * POST
     * Method to send data to FedEx and calculates all rates quotes
     * 
     * @param string $xmlFedExRequest
     * @return string
     */
    public function sendFedExRateRequest($xmlFedExRequest);
}