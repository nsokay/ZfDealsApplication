<?php

namespace ZfDeals\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\Stdlib\Hydrator\Reflection;
use ZfDeals\Entity\Product as ProductEntity;
use ZfDeals\Form\ProductAdd as ProductAddForm;
use Zend\View\Model\ViewModel;

class ProductAddFormController extends AbstractFormController
{
    private $productMapper;

    public function __construct(ProductAddForm $form)
    {
        parent::__construct($form);
    }

    public function prepare()
    {
        $this->form->setHydrator(new Reflection());
        $this->form->bind(new ProductEntity());
    }

    public function process()
    {
        $model = new ViewModel(
            array(
                'form' => $this->form
            )
        );

        try {
            $this->productMapper->insert($this->form->getData());
            $model->setVariable('success', true);
        } catch (\Exception $e) {
            $model->setVariable('insertError', true);
        }

        return $model;
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
}
