<?php

namespace Integration\Zippopotamus\Api;

interface ZippopotamusIntegrationInterface 
{
    /**
     * GET
     * Retrieve the state information by zip code via Zippopotamus API
     * 
     * @param string $zipCode
     * @return string
     */
    public function sendStateRequest($zipCode);
}