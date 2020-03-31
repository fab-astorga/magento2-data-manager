<?php
 
namespace Midwr\Manager\Block\Author;
 
use \Magento\Framework\View\Element\Template\Context;
use Midwr\Manager\Model\AuthorFactory;

class View extends \Magento\Framework\View\Element\Template
{
    protected $_author;

    public function __construct(
        Context $context,
        AuthorFactory $author
    ) {
        $this->_author = $author;
        parent::__construct($context);
    }
 
    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('View Author'));        
        return parent::_prepareLayout();
    }
 
    public function getSingleAuthor()
    {
        $id = $this->getRequest()->getParam('id');
        $author = $this->_author->create();
        $singleAuthor = $author->load($id);
        return $singleAuthor;
    }
}