<?php
 
namespace Midwr\Manager\Controller\Book;
 
use \Magento\Framework\App\Action\Context;
use \Magento\Framework\App\Cache\TypeListInterface;
use \Magento\Framework\App\Cache\Frontend\Pool;
use Midwr\Manager\Model\BookFactory;
use \Psr\Log\LoggerInterface;

class Save extends \Magento\Framework\App\Action\Action
{
    protected $_book;
    protected $_cacheTypeList;
    protected $_cacheFrontendPool;
    protected $_logger;
 
	public function __construct(
		Context $context,
        BookFactory $book,
        TypeListInterface $cacheTypeList,
        Pool $cacheFrontendPool,
        LoggerInterface $logger
    ) {
        $this->_book = $book;
        $this->_cacheTypeList = $cacheTypeList;
        $this->_cacheFrontendPool = $cacheFrontendPool;
        $this->_logger = $logger;
        parent::__construct($context);
    }
	public function execute()
    {
        /****** Custom indexer test ******/
        $bookId = $this->getRequest()->getParam('book_id');
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $buildOpt = $objectManager->create('Midwr\Manager\Model\Indexer\CustomIndexer');

        $data = $this->getRequest()->getParams();
        $book = $this->_book->create();
        $book->setData($data);
        $buildOpt->executeRow($bookId);

        $checkMessage = ( $book->save() ) ? 'You saved the data.' :  'Data was not saved.';
        $this->messageManager->addNoticeMessage(__($checkMessage));
                   
            /******  Clean cache in order to catch changes ******/
        $types = array('block_html','collections', 'full_page');
        foreach ($types as $type) {
            $this->_cacheTypeList->cleanType($type);
        }
        foreach ($this->_cacheFrontendPool as $cacheFrontend) {
            $cacheFrontend->getBackend()->clean();
        }
        
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('manager/book/add');
        return $resultRedirect;
    }
}