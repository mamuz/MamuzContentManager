<?php

namespace MamuzContentManagerTest\Controller;

use MamuzContentManager\Controller\QueryController;
use MamuzContentManagerTest\Bootstrap;
use Zend\Http\PhpEnvironment\Request;
use Zend\Http\PhpEnvironment\Response;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use Zend\Mvc\Router\RouteMatch;

class QueryControllerTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Zend\Mvc\Controller\AbstractActionController */
    protected $fixture;

    /** @var Request */
    protected $request;

    /** @var Response */
    protected $response;

    /** @var RouteMatch */
    protected $routeMatch;

    /** @var MvcEvent */
    protected $event;

    /** @var \MamuzContentManager\Feature\QueryInterface | \Mockery\MockInterface */
    protected $queryInterface;

    /** @var \MamuzContentManager\Entity\Page | \Mockery\MockInterface */
    protected $page;

    /** @var string */
    protected $path = 'foo';

    protected function setUp()
    {
        $this->queryInterface = \Mockery::mock('MamuzContentManager\Feature\QueryInterface');

        /** @var \Zend\ServiceManager\ServiceManager $serviceManager */
        $serviceManager = Bootstrap::getServiceManager();
        $this->fixture = new QueryController($this->queryInterface);
        $this->request = new Request();
        $this->routeMatch = new RouteMatch(array('controller' => 'index'));
        $this->event = new MvcEvent();
        $config = $serviceManager->get('Config');
        $routerConfig = isset($config['router']) ? $config['router'] : array();
        $router = HttpRouter::factory($routerConfig);

        $params = \Mockery::mock('Zend\Mvc\Controller\Plugin\Params');
        $params->shouldReceive('__invoke')->andReturn($params);
        $params->shouldReceive('fromRoute')->with('path')->andReturn($this->path);
        $pluginManager = \Mockery::mock('Zend\Mvc\Controller\PluginManager')->shouldIgnoreMissing();
        $pluginManager->shouldReceive('get')->with('params', null)->andReturn($params);

        $this->fixture->setPluginManager($pluginManager);
        $this->event->setRouter($router);
        $this->event->setRouteMatch($this->routeMatch);
        $this->fixture->setEvent($this->event);
        $this->fixture->setServiceLocator($serviceManager);
    }

    public function testExtendingZendActionController()
    {
        $this->assertInstanceOf('Zend\Mvc\Controller\AbstractActionController', $this->fixture);
    }

    public function testQueryActionCanBeAccessed()
    {
        $content = 'baz';
        $this->page = \Mockery::mock('MamuzContentManager\Entity\Page');
        $this->page->shouldReceive('getContent')->andReturn($content);

        $this->queryInterface
            ->shouldReceive('findActivePageByPath')
            ->with($this->path)
            ->andReturn($this->page);

        $this->routeMatch->setParam('action', 'page');
        $result = $this->fixture->dispatch($this->request);
        $response = $this->fixture->getResponse();

        $this->assertInstanceOf('Zend\View\Model\ModelInterface', $result);
        $this->assertSame($this->page, $result->getVariables()['page']);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testQueryActionPageNotFoundByNullPage()
    {
        $this->page = \Mockery::mock('MamuzContentManager\Entity\NullPage');

        $this->queryInterface
            ->shouldReceive('findActivePageByPath')
            ->with($this->path)
            ->andReturn($this->page);

        $this->routeMatch->setParam('action', 'page');
        $result = $this->fixture->dispatch($this->request);
        $response = $this->fixture->getResponse();

        $this->assertNull($result);
        $this->assertEquals(404, $response->getStatusCode());
    }
}
