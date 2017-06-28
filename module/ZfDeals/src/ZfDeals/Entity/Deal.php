<?php
namespace ZfDeals\Entity;

class Deal
{
    protected $dealId;
    protected $price;
    protected $startDate;
    protected $endDate;
    protected $product;

    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }
    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $dealId
     */
    public function setDealId($dealId)
    {
        $this->dealId = $dealId;
    }

    /**
     * @return mixed
     */
    public function getDealId()
    {
        return $this->dealId;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

}