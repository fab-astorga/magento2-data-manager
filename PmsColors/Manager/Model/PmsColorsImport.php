<?php
namespace PmsColors\Manager\Model;

use Magento\Framework\Exception\CouldNotSaveException;

class PmsColorsImport
{
    const PMS_FILE    = 'csv/pms_colors.csv';
    const INTERNAL_ID = 0;
    const NAME        = 1;
    const HEX_CODE    = 2;
    const RED         = 3;
    const GREEN       = 4;
    const BLUE        = 5;

    protected $_pantoneColorRepository;
    protected $_pantoneListCollection;
    private $_helper;

    public function __construct(
        \PmsColors\Manager\Api\PantoneListRepositoryInterface $pantoneColorRepository,
        \PmsColors\Manager\Model\ResourceModel\PantoneList\CollectionFactory $pantoneListCollection,
        \PmsColors\Manager\Helper\Data $helper
    ) 
    {
        $this->_pantoneColorRepository = $pantoneColorRepository;
        $this->_pantoneListCollection  = $pantoneListCollection;
        $this->_helper                 = $helper;
    }

    /**
     * {@inheritdoc}
     */
    public function importPmsColorsFromCsv() 
    {
        try { 
            $pmsColors = $this->_helper->parseCsvFile(self::PMS_FILE);
            foreach ($pmsColors as $pmsColor) 
            { 
                $this->_pantoneColorRepository->save(
                    $pmsColor[self::INTERNAL_ID],
                    $pmsColor[self::NAME],
                    $pmsColor[self::HEX_CODE],
                    $pmsColor[self::RED],
                    $pmsColor[self::GREEN],
                    $pmsColor[self::BLUE]
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
    public function getPmsColors()
    {
        $collection = $this->_pantoneListCollection->create();
        return $collection->getData();
    }
}