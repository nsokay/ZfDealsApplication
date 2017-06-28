<?php
namespace ZfDeals\Form;

use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterProviderInterface;

class ProductFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('product');

        $this->add(array(
            'name' => 'productId',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Product ID:',
            )
        ));

        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => 'Product name:',
            )
        ));

        $this->add(array(
            'name' => 'stock',
            'attributes' => array(
                'type' => 'nubmer',
            ),
            'options' => array(
                'label' => 'Amount of product:'
            ),
        ));
    }

    public function getInputFilterSpecification()
    {
        // TODO: Implement getInputFilterSpecification() method.
        return array(
            'productId' => array(
                'required' => true,
                'filters' => array(
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'notEmpty',
                        'options' => array(
                            'message' => "Please, enter product id"
                        )
                    )
                )
            ),
            'name' => array(
                'required' => true,
                'filters' => array(
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'message' => "Please, enter product name"
                        ),
                    )
                )
            ),
            'stock' => array(
                'required' => true,
                'filters' => array(
                    array(
                        'name' => 'StringTrim'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'message' => "Please enter amount"
                        )
                    ),
                    array(
                        'name' => 'Digits',
                        'options' => array(
                            'message' => "Please enter round number"
                        )
                    ),
                    array(
                        'name' => 'GreaterThan',
                        'options' => array(
                            'min' => 0,
                            'message' => "Please enter amount that is >= 0"
                        )
                    )
                )
            )
        );
    }
}
