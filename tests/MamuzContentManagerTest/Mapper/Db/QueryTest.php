<?php

namespace MamuzContentManagerTest\Mapper\Db;

use MamuzContentManager\EventManager\Event;
use MamuzContentManager\Mapper\Db\Query;

class QueryTest extends \PHPUnit_Framework_TestCase
{
    /** @var Query */
    protected $fixture;

    /** @var \Doctrine\Common\Persistence\ObjectRepository | \Mockery\MockInterface */
    protected $entityRepository;

    /** @var \MamuzContentManager\Entity\Page | \Mockery\MockInterface */
    protected $entity;

    /** @var \Zend\EventManager\EventManagerInterface | \Mockery\MockInterface */
    protected $eventManager;

    /** @var \Zend\EventManager\ResponseCollection | \Mockery\MockInterface */
    protected $reponseCollection;

    protected function setUp()
    {
        $this->entity = \Mockery::mock('MamuzContentManager\Entity\Page');
        $this->entityRepository = \Mockery::mock('Doctrine\Common\Persistence\ObjectRepository');

        $this->fixture = new Query($this->entityRepository);

        $this->eventManager = \Mockery::mock('Zend\EventManager\EventManagerInterface');
        $this->fixture->setEventManager($this->eventManager);

        $this->reponseCollection = \Mockery::mock('Zend\EventManager\ResponseCollection')->shouldIgnoreMissing();
    }

    protected function prepareEventManagerForFind($path, $stopped = false, $entityIsNull = false)
    {
        $this->reponseCollection->shouldReceive('stopped')->once()->andReturn($stopped);

        if ($stopped) {
            $this->reponseCollection->shouldReceive('last')->andReturn($entityIsNull ? null : $this->entity);
        }

        $this->eventManager->shouldReceive('trigger')->once()->with(
            Event::PRE_PAGE_RETRIEVAL,
            $this->fixture,
            array('path' => $path)
        )->andReturn($this->reponseCollection);
    }

    public function testImplementingQueryInterface()
    {
        $this->assertInstanceOf('MamuzContentManager\Feature\QueryInterface', $this->fixture);
    }

    public function testFindPublishedPageByPath()
    {
        $path = 'foo';
        $this->prepareEventManagerForFind($path);

        $this->eventManager->shouldReceive('trigger')->with(
            Event::POST_PAGE_RETRIEVAL,
            $this->fixture,
            array('path' => $path, 'page' => $this->entity)
        );

        $this->entityRepository
            ->shouldReceive('findOneBy')
            ->with(
                array(
                    'path'      => $path,
                    'published' => true,
                )
            )
            ->andReturn($this->entity);

        $this->assertSame($this->entity, $this->fixture->findPublishedPageByPath($path));
    }

    public function testFindPublishedPageByPathWithStoppedEvent()
    {
        $path = 'foo';
        $this->prepareEventManagerForFind($path, true, true);

        $this->eventManager->shouldReceive('trigger')->with(
            Event::POST_PAGE_RETRIEVAL,
            $this->fixture,
            array('path' => $path, 'page' => $this->entity)
        );

        $this->entityRepository
            ->shouldReceive('findOneBy')
            ->with(
                array(
                    'path'      => $path,
                    'published' => true,
                )
            )
            ->andReturn($this->entity);

        $this->assertSame($this->entity, $this->fixture->findPublishedPageByPath($path));
    }

    public function testFindPublishedPageByPathWithEventEntity()
    {
        $path = 'foo';
        $this->prepareEventManagerForFind($path, true);
        $this->assertSame($this->entity, $this->fixture->findPublishedPageByPath($path));
    }

    public function testFindPublishedPageByPathWithNullPage()
    {
        $path = 'foo';
        $this->prepareEventManagerForFind($path);

        $this->eventManager->shouldReceive('trigger')->andReturnUsing(
            function ($event, $target, $argv) use ($path) {
                $this->assertSame(Event::POST_PAGE_RETRIEVAL, $event);
                $this->assertSame($this->fixture, $target);
                $this->assertSame($path, $argv['path']);
                $this->assertInstanceOf(
                    'MamuzContentManager\Entity\NullPage',
                    $argv['page']
                );
            }
        );

        $this->entityRepository
            ->shouldReceive('findOneBy')
            ->with(
                array(
                    'path'      => $path,
                    'published' => true,
                )
            )
            ->andReturn(null);

        $this->assertInstanceOf(
            'MamuzContentManager\Entity\NullPage',
            $this->fixture->findPublishedPageByPath($path)
        );
    }

    public function testFindPublishedPageByPathWithNullPageAndWithStoppedEvent()
    {
        $path = 'foo';
        $this->prepareEventManagerForFind($path, true, true);

        $this->eventManager->shouldReceive('trigger')->andReturnUsing(
            function ($event, $target, $argv) use ($path) {
                $this->assertSame(Event::POST_PAGE_RETRIEVAL, $event);
                $this->assertSame($this->fixture, $target);
                $this->assertSame($path, $argv['path']);
                $this->assertInstanceOf(
                    'MamuzContentManager\Entity\NullPage',
                    $argv['page']
                );
            }
        );

        $this->entityRepository
            ->shouldReceive('findOneBy')
            ->with(
                array(
                    'path'      => $path,
                    'published' => true,
                )
            )
            ->andReturn(null);

        $this->assertInstanceOf(
            'MamuzContentManager\Entity\NullPage',
            $this->fixture->findPublishedPageByPath($path)
        );
    }
}
