<?php

namespace Items\ItemInformation\Helper; 

use Magento\Framework\App\Helper\Context;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\Escaper;
use Magento\Framework\Mail\Template\TransportBuilder;

class Email extends \Magento\Framework\App\Helper\AbstractHelper
{
    const EMAIL_SUPPORT = 'testmidware@gmail.com';
    
    protected $inlineTranslation;
    protected $escaper;
    protected $transportBuilder;
    protected $logger;
    protected $_customerSession;
    protected $_logger;
    protected $_customerRepository;

    public function __construct(
        Context $context,
        StateInterface $inlineTranslation,
        Escaper $escaper,
        TransportBuilder $transportBuilder,
        \Magento\Customer\Model\Session $customerSession,
        \File\CustomLog\Logger\Logger $logger,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository
    ) {
        parent::__construct($context);
        $this->inlineTranslation = $inlineTranslation;
        $this->escaper = $escaper;
        $this->transportBuilder = $transportBuilder;
        $this->logger = $context->getLogger();
        $this->_customerSession = $customerSession;
        $this->_logger = $logger;
        $this->_customerRepository = $customerRepository;
    }

    public function sendSpecialQuoteEmail($qty, $sku)
    {
        try {
            // Retrieve customer email
            $idCustomer = $this->_customerSession->getCustomer()->getId();
            $customer = $this->_customerRepository->getById($idCustomer);

            $this->inlineTranslation->suspend();
            $sender = [
                'name' => $this->escaper->escapeHtml('Special Quote Request'), //send email
                'email' => $this->escaper->escapeHtml(self::EMAIL_SUPPORT), //send email
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
                    'customer'  => $customer->getFirstname() . ' ' .$customer->getLastname(), //email content
                    'sku' => $sku,
                    'qty'  => $qty
                ])
                ->setFrom($sender)
                ->addTo($customer->getEmail()) //receive email
                ->getTransport();
            $transport->sendMessage();
            $this->inlineTranslation->resume();
        } catch (\Exception $e) {
            $this->logger->debug($e->getMessage());
            return false;
        }

        return true;
    }
}