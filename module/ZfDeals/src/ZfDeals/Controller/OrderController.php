<?php
namespace ZfDeals\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class OrderController extends AbstractActionController
{
    private $orderMapper;

    public function showAllAction()
    {
        $orders = $this->orderMapper->select();

        return new ViewModel(
            array(
                'orders' => $orders
            )
        );
    }
    /**
     * @param mixed $orderMapper
     */
    public function setOrderMapper($orderMapper)
    {
        $this->orderMapper = $orderMapper;
    }
    /**
     * @return mixed
     */
    public function getOrderMapper()
    {
        return $this->orderMapper;
    }

}