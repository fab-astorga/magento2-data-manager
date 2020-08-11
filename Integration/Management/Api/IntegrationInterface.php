<?php

namespace Integration\Management\Api;

interface IntegrationInterface 
{
    /**
     * POST
     * Method to send data to Netsuite and start an specific integration procedure
     * based on method, script and deploy parameters
     * 
     * @param  array $data
     * @param string $method
     * @param int $script
     * @param int $deploy
     * @return string
     */
    public function sendNetsuiteRequest($data, $method, $script, $deploy);

    /**
     * GET
     * Method to send data to Netsuite and start an specific integration procedure
     * based on url, method, script and deploy parameters and retrieve information
     * 
     * @param  string $url
     * @param string $method
     * @param int $script
     * @param int $deploy
     * @param array $params
     * @return string
     */
    public function getNetsuiteResponse($url, $method, $script, $deploy, $params);
}