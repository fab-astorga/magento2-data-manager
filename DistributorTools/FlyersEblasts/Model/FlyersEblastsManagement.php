<?php
namespace DistributorTools\FlyersEblasts\Model;

use Magento\Framework\Exception\CouldNotSaveException;

class FlyersEblastsManagement
{
    const PV_FILE  = 'csv/flyers_eblasts.csv';
    const ID       = 0;
    const NAME     = 1;
    const IMG      = 2;

    protected $_flyersEblastsRepository;
    protected $_flyersEblastsCollection;
    private $_helper;

    public function __construct(
        \DistributorTools\FlyersEblasts\Api\FlyersEblastsRepositoryInterface $flyersEblastsRepository,
        \DistributorTools\FlyersEblasts\Model\ResourceModel\FlyersEblasts\CollectionFactory $flyersEblastsCollection,
        \Services\PmsColors\Helper\Data $helper
    ) 
    {
        $this->_flyersEblastsRepository = $flyersEblastsRepository;
        $this->_flyersEblastsCollection = $flyersEblastsCollection;
        $this->_helper                  = $helper;
    }

    /**
     * {@inheritdoc}
     */
    public function importFlyersEblastsFromCsv() 
    {
        try { 
            $this->_flyersEblastsRepository->delete();            
            $flyersEblasts = $this->_helper->parseCsvFile(self::PV_FILE);

            foreach ($flyersEblasts as $flyersEblast) 
            { 
                $this->_flyersEblastsRepository->save(
                    $flyersEblast[self::ID],
                    $flyersEblast[self::NAME],
                    $flyersEblast[self::IMG]
                );
            }
            return true;

        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getFlyersEblasts()
    {
        $collection = $this->_flyersEblastsCollection->create();
        return $collection->getData();
    }
}