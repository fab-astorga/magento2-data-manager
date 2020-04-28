<?php
namespace TestOrder\Custom\Model;
use TestOrder\Custom\Api\CustomOrderInterface;

class CustomOrderManagement implements CustomOrderInterface
{

    protected $orderRepository;
    protected $searchCriteriaBuilder;
    
    public function __construct(
        \Magento\Sales\Model\OrderRepository $orderRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->orderRepository = $orderRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * {@inheritdoc}
     * This method makes a server update due to a POST event in the current branch.
     */
    public function getOrders(){
        $this->searchCriteriaBuilder->setPageSize(20);

        $searchCriteria = $this->searchCriteriaBuilder->create();
        $productsItems  = $this->orderRepository->get(1);


        return $productsItems; 
    }

    /**
     * {@inheritdoc}
     * This method makes a server update due to a POST event in the current branch.
     */
    public function updateOrder(){

        $order  = $this->orderRepository->get(1);

        $orderSave = $this->orderRepository->save($order);

        return $orderSave; 
    }
    
    
}
