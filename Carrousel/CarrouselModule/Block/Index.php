<?php
namespace Carrousel\CarrouselModule\Block;
class Index extends \Magento\Framework\View\Element\Template
{

    protected $_catalogSession;
    protected $_customerSession;
    protected $_checkoutSession;
        
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,        
        \Magento\Customer\Model\Session $customerSession,
        array $data = []
    )
    {        
        $this->_customerSession = $customerSession;
        parent::__construct($context, $data);
    }
    
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
        
    
    public function getCustomerSession() 
    {
        return $this->_customerSession;
    }
    


}