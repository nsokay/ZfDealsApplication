<?php
return array(
    'router' => array(
        'routes' => array(
            'zf-deals\admin\home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/deals/admin',
                    'defaults' => array(
                        'controller' => 'ZfDeals\Controller\Admin',
                        'action' => 'index',
                    ),
                ),
            ),
            'zf-deals\admin\product\add' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/deals/admin/product/add',
                    'defaults' => array(
                        'controller' => 'ZfDeals\Controller\ProductAddForm',
                    ),
                ),
            ),
            'zf-deals\admin\deal\add' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/deals/admin/deal/add',
                    'defaults' => array(
                        'controller' => 'ZfDeals\Controller\DealAddForm',
                    )
                )
            ),
            'zf-deals' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/deals',
                    'defaults' => array(
                        'controller' => 'ZfDeals\Controller\Index',
                        'action' => 'index'
                    )
                )
            )
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'zf-deals/layout/admin' => __DIR__ . '/../view/layout/admin.phtml',
            'zf-deals/layout/site' => __DIR__ . '/../view/layout/site.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),

    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => function ($sm) {
                $config = $sm->get('Config');
                $dbParams = $config['dbParams'];

                return new Zend\Db\Adapter\Adapter(array(
                        'driver' => $dbParams['driver'],
                        'hostname' => $dbParams['hostname'],
                        'database' => $dbParams['database'],
                        'username' => $dbParams['username'],
                        'password' => $dbParams['password'],
                        'driver_options' => $dbParams['driver_options']
                ));
            },
        )
    )
);
