<?php
 
namespace Midwr\Manager\Controller\Author;
 
class Show extends \Magento\Framework\App\Action\Action
{
	public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }
}