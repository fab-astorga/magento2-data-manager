<?php

namespace PmsColors\Manager\Helper;
 
use \Magento\Framework\App\Helper\AbstractHelper;
 
/**
 * Helper for PMS Colors module
 */
class Data extends AbstractHelper
{
    /**
     * Convert data of csv file to an array
     * 
     */
    public function parseCsvFile($file)
    {
        $options = array();
        $handle = fopen($file, "r");
        $headers = false;

        if (empty($handle) === false) 
        {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
            {
                if (!$headers)
                    $headers[] = $data;
                else
                    $options[] = $data;
            }
            fclose($handle);
        }
        return $options;
    } 
}