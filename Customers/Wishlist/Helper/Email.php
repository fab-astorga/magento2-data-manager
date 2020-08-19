<?php
namespace Customers\Wishlist\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\Escaper;
use Magento\Framework\Mail\Template\TransportBuilder;

class Email extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $inlineTranslation;
    protected $escaper;
    protected $transportBuilder;
    protected $logger;

    public function __construct(
        Context $context,
        StateInterface $inlineTranslation,
        Escaper $escaper,
        TransportBuilder $transportBuilder
    ) {
        parent::__construct($context);
        $this->inlineTranslation = $inlineTranslation;
        $this->escaper = $escaper;
        $this->transportBuilder = $transportBuilder;
        $this->logger = $context->getLogger();
    }

    /**
     * {@inheritdoc}
     */
    public function sendWishlistEmail($data,$distributorEmail)
    {
        try {
            $this->inlineTranslation->suspend();
            $sender = [
                'name' => $this->escaper->escapeHtml('Test'), //send email
                'email' => $this->escaper->escapeHtml('testmidware@gmail.com'), //send email
            ];
            $transport = $this->transportBuilder
                ->setTemplateIdentifier('emailTemplate') //id html
                ->setTemplateOptions(
                    [
                        'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                        'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
                    ]
                )
                ->setTemplateVars([
                    'item_sku'       => $data[0]['sku'],
                    'item_name'      => $data[0]['name'],
                    'item_price'     => $data[0]['price'],
                    'item_weight'    => $data[0]['weight']
                ])
                ->setFrom($sender)
                ->addTo($distributorEmail) //receive email
                ->getTransport();
            $transport->sendMessage();
            $this->inlineTranslation->resume();
        } catch (\Exception $e) {
            $this->logger->debug($e->getMessage());
        }
    }
}