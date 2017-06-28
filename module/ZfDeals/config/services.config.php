<?php
return array(
    'factories' => array(
        'ZfDeals\Mapper\Product' => function ($sm) {
            return new \ZfDeals\Mapper\Product(
                $sm->get('Zend\Db\Adapter\Adapter')
            );
        },
        'ZfDeals\Mapper\Deal' => function ($sm) {
            return new \ZfDeals\Mapper\Deal(
                $sm->get('Zend\Db\Adapter\Adapter')
            );
        },
    ),
);
