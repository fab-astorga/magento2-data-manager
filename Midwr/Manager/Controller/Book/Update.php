<?php
 
namespace Midwr\Manager\Controller\Book;
 
use \Magento\Framework\App\Action\Context;
use \Magento\Framework\App\Cache\TypeListInterface;
use \Magento\Framework\App\Cache\Frontend\Pool;
use Midwr\Manager\Model\BookFactory;

class Update extends \Magento\Framework\App\Action\Action
{
    protected $_book;
    protected $_cacheTypeList;
    protected $_cacheFrontendPool;
 
	public function __construct(
		Context $context,
        BookFactory $book,
        TypeListInterface $cacheTypeList,
        Pool $cacheFrontendPool
    ) 
    {
        $this->_book = $book;
        $this->_cacheTypeList = $cacheTypeList;
        $this->_cacheFrontendPool = $cacheFrontendPool;
        parent::__construct($context);
    }

	public function execute()
    {
        /****** Custom indexer test ******/
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $buildOpt = $objectManager->create('Midwr\Manager\Model\Indexer\CustomIndexer');

        $id = $this->getRequest()->getParam('id');
        $params = $this->getRequest()->getParams();

        $collection = $this->_book->create()->getCollection()
                 ->addFieldToFilter('book_id', array('eq' => $id));

        foreach($collection as $item)
        {
            $item->setTitle( $params['title'] );
            $item->setAuthor( $params['author'] );
            $item->setContent( $params['content'] );
        }
        $buildOpt->executeRow($id);

        $checkMessage = ( $collection->save() ) ? 'You updated the data.' :  'Data was not updated.';
        $this->messageManager->addNoticeMessage(__($checkMessage));

            // Clean cache in order to catch changes
        $types = array('block_html','collections', 'full_page');
        foreach ($types as $type) 
        {
            $this->_cacheTypeList->cleanType($type);
        }
        
        foreach ($this->_cacheFrontendPool as $cacheFrontend)
        {
            $cacheFrontend->getBackend()->clean();    
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('manager/book/select');
        return $resultRedirect;
    }
}