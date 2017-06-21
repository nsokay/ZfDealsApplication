<?php
namespace ZfDeals\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Stdlib\Hydrator\Reflection;
use Zend\View\Model\ViewModel;


class ProductAddFormController extends AbstractActionController
{
    public function addProductAction()
    {
        $form = new \ZfDeals\Form\ProductAdd();

        if ($this->getRequest()->isPost()) {
            $form->setHydrator(new \Zend\Stdlib\Hydrator\Reflection());
            $form->bind(new \ZfDeals\Entity\Product());
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                $newEntity = $form->getData();

                $mapper = $this->getServiceLocator()->get('ZfDeals\Mapper\Product');
                $mapper->insert($newEntity);
                $form = new \ZfDeals\Form\ProductAdd();

                return new ViewModel(
                    array(
                        'form' => $form,
                        'success' => true
                    )
                );
            } else {
                return new ViewModel(
                    array(
                        'form' => $form
                    )
                );
            }
        } else {
            return new ViewModel(
                array(
                    'form' => $form
                )
            );
        }
    }
}
