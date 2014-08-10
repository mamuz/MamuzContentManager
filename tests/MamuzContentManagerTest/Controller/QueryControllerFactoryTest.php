<?php

namespace MamuzContentManagerTest\Controller;

use MamuzContentManager\Controller\QueryControllerFactory;

class QueryControllerFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var QueryControllerFactory */
    protected $fixture;

    protected function setUp()
    {
        $this->fixture = new QueryControllerFactory;
    }

    public function testImplementingFactoryInterface()
    {
        $this->assertInstanceOf('Zend\ServiceManager\FactoryInterface', $this->fixture);
    }

    public function testCreation()
    {
        $queryInterface = \Mockery::mock('MamuzContentManager\Feature\QueryInterface');
        $sm = \Mockery::mock('Zend\ServiceManager\ServiceLocatorInterface');
        $sm->shouldReceive('getServiceLocator')->andReturn($sm);
        $sm->shouldReceive('get')->with('MamuzContentManager\DomainManager')->andReturn($sm);
        $sm->shouldReceive('get')->with('MamuzContentManager\Service\Query')->andReturn($queryInterface);

        $controller = $this->fixture->createService($sm);

        $this->assertInstanceOf('Zend\Mvc\Controller\AbstractController', $controller);
    }

    public function testCreationWithServiceLocatorAwareness()
    {
        $sm = \Mockery::mock('Zend\ServiceManager\ServiceLocatorInterface');

        $sl = \Mockery::mock('Zend\ServiceManager\AbstractPluginManager');
        $sl->shouldReceive('getServiceLocator')->andReturn($sm);

        $queryInterface = \Mockery::mock('MamuzContentManager\Feature\QueryInterface');
        $sm->shouldReceive('getServiceLocator')->andReturn($sm);
        $sm->shouldReceive('get')->with('MamuzContentManager\DomainManager')->andReturn($sm);
        $sm->shouldReceive('get')->with('MamuzContentManager\Service\Query')->andReturn($queryInterface);

        $controller = $this->fixture->createService($sl);

        $this->assertInstanceOf('Zend\Mvc\Controller\AbstractController', $controller);
    }
}
