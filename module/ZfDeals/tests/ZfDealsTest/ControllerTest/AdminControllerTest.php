<?php
namespace ZfDealsTest\ControllerTest;

use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use ZfDeals\Controller\AdminController;

class AdminControllerTest extends \PHPUnit_Framework_TestCase
{
    private $controller;
    private $request;
    private $response;
    private $routeMatch;
    private $event;

    public function setUp()
    {
        $this->controller = new AdminController();
        $this->request = new Request();
        $this->response = new Response();
        $this->routeMatch = new RouteMatch(array('controller' => 'admin'));
        $this->routeMatch->setParam('action', 'add-product');
        $this->event = new MvcEvent();
        $this->event->setRouteMatch($this->routeMatch);
        $this->controller->setEvent($this->event);
    }

    public function testShowFormOnGetRequest()
    {
        $fakeForm = new \Zend\Form\Form('fakeForm');
        $this->controller->setProductAddForm($fakeForm);
        $this->request->setMethod('get');
        $response = $this->controller->dispatch($this->request);
        $viewModelValues = $response->getVariables();
        $formReturned = $viewModelValues['form'];
        $this->assertEquals($formReturned->getName(), $fakeForm->getName());
    }

    public function testShowFormOnValidationError()
    {
        $fakeForm = $this->getMock('Zend\Form\Form', array('isValid'));

        $fakeForm->expects($this->once())
            ->method('isValid')
            ->will($this->returnValue(false));

        $this->controller->setProductAddForm($fakeForm);
        $this->request->setMethod('post');
        $response = $this->controller->dispatch($this->request);
        $viewModelValues = $response->getVariables();
        $formReturned = $viewModelValues['form'];
        $this->assertEquals($formReturned->getName(), $fakeForm->getName());
    }

    public function testCallMapperOnFormValidationSuccess()
    {
        $fakeForm = $this->getMock('Zend\Form\Form', array('isValid', 'getData'));
        $fakeForm->expects($this->once())->method('isValid')->will($this->returnValue(true));
        $fakeForm->expects($this->once())->method('getData')->will($this->returnValue(new \stdClass()));
        $fakeMapper = $this->getMock(
            'ZfDeals\Mapper\Product',
            array('insert'),
            array(),
            '',
            false
        );
        $fakeMapper->expects($this->once())->method('insert')->will($this->returnValue(true));

        $this->controller->setProductAddForm($fakeForm);
        $this->controller->setProductMapper($fakeMapper);
        $this->request->setMethod('post');
        $response = $this->controller->dispatch($this->request);
    }
}