<?php
namespace ZfDeals\Controller;

use Zend\View\Model\ViewModel;
use Zend\Stdlib\Hydrator\Reflection;
use ZfDeals\Entity\Order as OrderEntity;
use ZfDeals\Form\Checkout as Checkout;
use Zend\Mvc\Controller\AbstractActionController;

class CheckoutFormController extends AbstractFormController
{
    private $productMapper;
    private $dealMapper;
    private $dealActiveValidator;
    private $checkoutService;

    /**
     * @param mixed $checkoutService
     */
    public function setCheckoutService($checkoutService)
    {
        $this->checkoutService = $checkoutService;
    }

    /**
     * @return mixed
     */
    public function getCheckoutService()
    {
        return $this->checkoutService;
    }

    /**
     * @param mixed $dealActiveValidator
     */
    public function setDealActiveValidator($dealActiveValidator)
    {
        $this->dealActiveValidator = $dealActiveValidator;
    }

    /**
     * @return mixed
     */
    public function getDealActiveValidator()
    {
        return $this->dealActiveValidator;
    }
    public function __construct(Checkout $form)
    {
        parent::__construct($form);
    }

    public function prepare()
    {
        $this->form->setHydrator(new Reflection());
        $this->form->bind(new OrderEntity());
    }

    public function show()
    {
        if (!$this->dealActiveValidator->isValid($this->params()->fromQuery('id'))) {
            $this->redirect()->toRoute('zf-deals');
        }

        $this->form->get('order')->get('deal_id')->setValue($this->params()->fromQuery('id'));

        $model = new ViewModel(
            array(
                'form' => $this->form
            )
        );

        return $model;
    }

    public function process()
    {
        $newOrder = $this->form->getData();
        $newOrder->setDeal($this->form->get('order')->get('deal_id')->getValue());

        $model = new ViewModel(
            array(
                'form' => $this->form
            )
        );

        var_dump($newOrder);

        try {
            $this->checkoutService->process($newOrder);
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