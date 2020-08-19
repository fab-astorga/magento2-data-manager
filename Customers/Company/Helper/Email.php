<?php
namespace Customers\Company\Helper;

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
    public function sendGSEmail($data)
    {
        try {
            var_dump('enviando correo');
            $this->inlineTranslation->suspend();
            $sender = [
                'name' => $this->escaper->escapeHtml('Test'), //send email
                'email' => $this->escaper->escapeHtml('testmidware@gmail.com'), //send email
            ];
            $transport = $this->transportBuilder
                ->setTemplateIdentifier('registerTemplate') //id html
                ->setTemplateOptions(
                    [
                        'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                        'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
                    ]
                )
                ->setTemplateVars([
                    'company_name' => $data['company_name'],
                    'email_address' => $data['email_address'],
                    'business_phone' => $data['business_phone'],
                    'state_sales_tax_license' => $data['state_sales_tax_license'],
                    'website_address' => $data['website_address'],
                    'preferred_mode_of_delivery' => $data['preferred_mode_of_delivery'],
                    'alt_phone' => $data['alt_phone'],
                    'fax' => $data['fax'],
                    'price_level' => $data['price_level'],
                    'additional_invoice_email_recipient' => $data['additional_invoice_email_recipient'],
                    'permission' => $data['permission'],
                    /////////////////////////////
                    'zip' => $data['addresses'][0]['zip'],
                    'country' => $data['addresses'][0]['country'],
                    'address' => $data['addresses'][0]['address'],
                    'city' => $data['addresses'][0]['city'],
                    'apt_suite' => $data['addresses'][0]['apt_suite'],
                    'state' => $data['addresses'][0]['state'],
                    'set_is_default_my_address' => $data['addresses'][0]['set_is_default_my_address'],
                    'set_is_default_billing' => $data['addresses'][0]['set_is_default_billing'],
                    'set_is_default_shipping' => $data['addresses'][0]['set_is_default_shipping'],
                    /////////////////////////////
                    's_zip' => $data['addresses'][1]['zip'],
                    's_country' => $data['addresses'][1]['country'],
                    's_address' => $data['addresses'][1]['address'],
                    's_city' => $data['addresses'][1]['city'],
                    's_apt_suite' => $data['addresses'][1]['apt_suite'],
                    's_state' => $data['addresses'][1]['state'],
                    's_set_is_default_my_address' => $data['addresses'][1]['set_is_default_my_address'],
                    's_set_is_default_billing' => $data['addresses'][1]['set_is_default_billing'],
                    's_set_is_default_shipping' => $data['addresses'][1]['set_is_default_shipping'],
                    /////////////////////////////
                    'b_zip' => $data['addresses'][2]['zip'],
                    'b_country' => $data['addresses'][2]['country'],
                    'b_address' => $data['addresses'][2]['address'],
                    'b_city' => $data['addresses'][2]['city'],
                    'b_apt_suite' => $data['addresses'][2]['apt_suite'],
                    'b_state' => $data['addresses'][2]['state'],
                    'b_set_is_default_my_address' => $data['addresses'][2]['set_is_default_my_address'],
                    'b_set_is_default_billing' => $data['addresses'][2]['set_is_default_billing'],
                    'b_set_is_default_shipping' => $data['addresses'][2]['set_is_default_shipping']
                ])
                ->setFrom($sender)
                ->addTo('joss.johnson@midware.net') //receive email
                ->getTransport();
            $transport->sendMessage();
            $this->inlineTranslation->resume();
        } catch (\Exception $e) {
            $this->logger->debug($e->getMessage());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function sendPasswordEmail($data,$emailAddress)
    {
        try {
            $this->inlineTranslation->suspend();
            $sender = [
                'name' => $this->escaper->escapeHtml('Test'), //send email
                'email' => $this->escaper->escapeHtml('testmidware@gmail.com'), //send email
            ];
            $transport = $this->transportBuilder
                ->setTemplateIdentifier('passwordTemplate') //id html
                ->setTemplateOptions(
                    [
                        'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                        'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID,
                    ]
                )
                ->setTemplateVars([
                    'user_name'         => $data['user_name'],
                    'user_password'     => $data['user_password']
                    ])
                ->setFrom($sender)
                ->addTo($emailAddress) //receive email
                ->getTransport();
            
            $transport->sendMessage();
            $this->inlineTranslation->resume();
        } catch (\Exception $e) {
            $this->logger->debug($e->getMessage());
        }
    }
}