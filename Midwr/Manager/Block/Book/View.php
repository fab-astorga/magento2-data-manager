<?php
 
namespace Midwr\Manager\Block\Book;
 
use \Magento\Framework\View\Element\Template\Context;
use Midwr\Manager\Model\BookFactory;

class View extends \Magento\Framework\View\Element\Template
{
    protected $_book;

    public function __construct(
        Context $context,
        BookFactory $book
    ) {
        $this->_book = $book;
        parent::__construct($context);
    }
 
    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('View Book'));        
        return parent::_prepareLayout();
    }
 
    public function getSingleBook()
    {
        $id = $this->getRequest()->getParam('id');
        $book = $this->_book->create();
        $singleBook = $book->load($id);
        return $singleBook;
    }
}