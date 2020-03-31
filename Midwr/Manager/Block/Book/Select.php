<?php
 
namespace Midwr\Manager\Block\Book;
 
use \Magento\Framework\View\Element\Template\Context;
use \Magento\Framework\App\ResourceConnection; 
use Midwr\Manager\Model\BookFactory;
use \Psr\Log\LoggerInterface;

class Select extends \Magento\Framework\View\Element\Template
{
    protected $_book;
    protected $_logger;

    public function __construct(
        Context $context,
        BookFactory $book,
        LoggerInterface $logger
    ) 
    {
        $this->_book = $book;
        $this->_logger = $logger;
        parent::__construct($context);
    }
 
    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('Selected Books'));
        return parent::_prepareLayout();
    }
 
    public function getSelectedData()
    {
        $column = 'author';
        $data = 'Fabian';
        $fields = array('book_id', 'title', 'author', 'content');

        $collection = $this->_book->create()->getCollection()
                        ->addFieldToSelect($fields)
                        ->addFieldToFilter($column, array('eq'=>$data));

        return $collection;
    }   
}