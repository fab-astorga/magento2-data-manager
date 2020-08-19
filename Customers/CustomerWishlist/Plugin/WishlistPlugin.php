<?php

namespace Customers\CustomerWishlist\Plugin;

use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\App\Action\Context as Context;
use Magento\Framework\App\RequestInterface as RequestInterface;
use Magento\Framework\Controller\ResultFactory as ResultFactory;
use Magento\Framework\Session\SessionManagerInterface as SessionManagerInterface;
use Magento\Framework\Stdlib\CookieManagerInterface as CookieManagerInterface;
use Magento\Framework\Stdlib\Cookie\CookieMetadataFactory as CookieMetadataFactory;

class WishlistPlugin
{
    /**
     * Name of cookie that holds private content version
     */
    const COOKIE_NAME = 'guest_wishlist';

    /**
     * CookieManager
     *
     * @var CookieManagerInterface
     */
    private $cookieManager;

    /**
     * @var CookieMetadataFactory
     */
    private $cookieMetadataFactory;

    /**
     * @var SessionManagerInterface
     */
    private $sessionManager;

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;

    /**
     * @var \Magento\Customer\Model\Session
     */
    private $customSession;

    private $resultFactory;

    protected $registry;

    public function __construct(
        Context $context,
        ResultFactory $resultFactory,
        CookieManagerInterface $cookieManager,
        CookieMetadataFactory $cookieMetadataFactory,
        SessionManagerInterface $sessionManager,
        CustomerSession $customerSession
    ) {
        $this->resultRedirectFactory = $context->getResultRedirectFactory();
        $this->customerSession       = $customerSession;
        $this->cookieManager         = $cookieManager;
        $this->cookieMetadataFactory = $cookieMetadataFactory;
        $this->sessionManager        = $sessionManager;
        $this->resultFactory         = $resultFactory;
    }
    public function beforeBeforeDispatch(
        \Magento\Wishlist\Controller\Index\Plugin $coreSubject,
        \Magento\Framework\App\ActionInterface $subject,
        RequestInterface $request) {
        $obj = $request->getParams();
        if (!$this->customerSession->isLoggedIn()) {
            $cookieValue = explode(', ', $this->cookieManager->getCookie(self::COOKIE_NAME));
            if (empty($cookieValue)) {
                $cookieValue = array();
            }
            array_push($cookieValue, $obj['product']);
            $this->set(implode(', ', $cookieValue), 100);
        }
    }
    private function set($value, $duration = 86400)
    {
        $metadata = $this->cookieMetadataFactory
            ->createPublicCookieMetadata()
            ->setDuration($duration)
            ->setPath($this->sessionManager->getCookiePath())
            ->setDomain($this->sessionManager->getCookieDomain());
        $this->cookieManager->setPublicCookie(
            self::COOKIE_NAME,
            $value,
            $metadata
        );
    }
}