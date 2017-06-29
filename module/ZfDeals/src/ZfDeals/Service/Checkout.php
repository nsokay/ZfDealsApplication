<?php
namespace ZfDeals\Service;

use ZfDeals\Controller\ProductAddFormController;

class Checkout
{
    private $dealAvailable;
    private $orderMapper;
    private $productMapper;
    private $dealMapper;

    /**
     * @param mixed $dealMapper
     */
    public function setDealMapper($dealMapper)
    {
        $this->dealMapper = $dealMapper;
    }

    /**
     * @return mixed
     */
    public function getDealMapper()
    {
        return $this->dealMapper;
    }

    public function process($ordering)
    {
        try {
            $this->orderMapper->insert($ordering);
            $deal = $this->dealMapper->findOneById($ordering->getDeal());
            $product = $this->productMapper->findOneById($deal->getProduct());

            $this->productMapper->update(
                array('stock' => $product->getStock() - 1),
                array('productId' => $product->getProductId())
            );
        } catch (\Exception $e) {
            throw new \DomainException('Order could not be processed');
        }

        return true;
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

    /**
     * @param mixed $productMapper
     */
    public function setProductMapper($productMapper)
    {
        $this->productMapper = $productMapper;
    }

    /**
     * @return mixed
     */
    public function getProductMapper()
    {
        return $this->productMapper;
    }

    /**
     * @param mixed $dealAvailable
     */
    public function setDealAvailable($dealAvailable)
    {
        $this->dealAvailable = $dealAvailable;
    }

    /**
     * @return mixed
     */
    public function getDealAvailable()
    {
        return $this->dealAvailable;
    }
}