<?php
namespace ZfDeals\Validator;

use Zend\Validator\AbstractValidator;

class DealActive extends AbstractValidator
{
    private $productMapper;
    private $dealMapper;

    public function isValid($value)
    {
        try {
            $this->dealMapper->findActiveDealById($value);
        } catch (\DomainException $e) {
            return false;
        }

        return true;
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
}