<?php
 
namespace Customers\Company\Helper;

class EmailCourier extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $_transportBuilder;
    protected $_storeManager;
    protected $_inlineTranslation;
 
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Translate\Inline\StateInterface $state
    )
    {
        $this->_transportBuilder  = $transportBuilder;
        $this->_storeManager      = $storeManager;
        $this->_inlineTranslation = $state;
        parent::__construct($context);
    }
 
    /**
     * Send email to customer with the generated password
     *
     * @param string $email
     * @param string $password
     * @return  string
     */
    public function sendEmail($email, $password)
    {
        $templateId = 'my_custom_email_template'; // template id
        $fromEmail = 'fabian.astorga@midware.net';  // sender Email id
        $fromName = 'Gordon Sinclair';             // sender Name
        $toEmail = $email; // receiver email id
 
        try {
            // template variables pass here
            $templateVars = [
                'msg' => 'Esta es su contraseña: ' . $password,
                'msg1' => 'gracias!!!'
            ];
 
            $storeId = $this->storeManager->getStore()->getId();
 
            $from = ['email' => $fromEmail, 'name' => $fromName];
            $this->inlineTranslation->suspend();
 
            $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
            $templateOptions = [
                'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                'store' => $storeId
            ];
            $transport = $this->transportBuilder->setTemplateIdentifier($templateId, $storeScope)
                ->setTemplateOptions($templateOptions)
                ->setTemplateVars($templateVars)
                ->setFrom($from)
                ->addTo($toEmail)
                ->getTransport();
            $transport->sendMessage();
            $this->inlineTranslation->resume();
            
        } catch (\Exception $e) {
            $this->_logger->info($e->getMessage());
        }
    }
}