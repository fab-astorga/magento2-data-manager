<?php

namespace Midwr\Manager\Model\Indexer;

use \Magento\Framework\Indexer\CacheContent;

class CustomIndexer implements \Magento\Framework\Indexer\ActionInterface, \Magento\Framework\Mview\ActionInterface
{
    /* Should take into account all placed orders in the system */
    public function executeFull()
    {
        $this->testIndex();
        file_put_contents(BP.'/var/log/executeFull.log', print_r('executeFull', true).PHP_EOL, FILE_APPEND);
    } 

    /* Works with a set of placed orders (mass actions and so on) */
    public function executeList($ids)
    {
        $this->testIndex();
        file_put_contents(BP.'/var/log/executeList.log', print_r($ids, true).PHP_EOL, FILE_APPEND);
    }

    /* Works in runtime for a single order using plugins */
    public function executeRow($id)
    {
        $this->testIndex();
        file_put_contents(BP.'/var/log/executeRow.log', print_r($id, true).PHP_EOL, FILE_APPEND);
    }

    /* Used by mview, allows you to process multiple placed orders in the "Update on schedule" mode */
    public function execute($ids)
    {
        file_put_contents(BP.'/var/log/executeids.log', print_r($ids, true).PHP_EOL, FILE_APPEND);
    }

    public function testIndex()
    {

    }
}