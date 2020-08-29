<?php

namespace Integration\Ups\Api;

interface UpsIntegrationInterface 
{
    /**
     * POST
     * Method to send data to UPS and calculates all rates quotes
     * 
     * @param string $jsonUpsRequest
     * @return string
     */
    public function sendUpsRateRequest($jsonUpsRequest);
}