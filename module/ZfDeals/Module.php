<?php
namespace ZfDeals;

use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\ModuleRouteListener;


class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return include __DIR__ . '/config/services.config.php';
    }

    public function getControllerConfig()
    {
        return include __DIR__ . '/config/controllers.config.php';
    }

    public function getViewHelperConfig()
    {
        return include __DIR__ . '/config/viewhelper.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function init(ModuleManager $moduleManager)
    {
        $layoutConfig = array(
            'admin' => array(
                'ZfDeals\Controller\ProductAddFormController',
                'ZfDeals\Controller\AdminController',
                'ZfDeals\Controller\DealAddFormController',
                'ZfDeals\Controller\OrderController',
            ),
            'site' => array(
                'ZFDeals\Controller\IndexController',
                'ZfDeals\Controller\CheckoutFormController',
            )
        );

        foreach ($layoutConfig as $layout => $controllers) {
            foreach ($controllers as $controller) {
                $this->configureLayoutForController(
                    $moduleManager,
                    $controller,
                    "zf-deals/layout/$layout"
                );
            }
        }
    }

    public function configureLayoutForController($moduleManager, $controller, $layout)
    {
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
        $sharedEvents->attach(
            $controller,
            'dispatch',
            function ($e) use ($layout) {
                $controller = $e->getTarget();
                $controller->layout($layout);
            },
            100
        );
    }

    public function onBootstrap($e)
    {
        \Zend\Validator\AbstractValidator::setDefaultTranslator(
            $e->getApplication()->getServiceManager()->get('translator')
        );

        $translator = $e->getApplication()->getServiceManager()->get('translator');
        $translator
            ->setLocale(\Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']))
            ->setFallbackLocale('ru_RU');

        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }
}