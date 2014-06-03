<?php

namespace MamuzContentManagerTest\Service;

use MamuzContentManager\Service\Query;

class QueryTest extends \PHPUnit_Framework_TestCase
{
    /** @var Query */
    protected $fixture;

    /** @var \MamuzContentManager\Feature\QueryInterface | \Mockery\MockInterface */
    protected $mapper;

    /** @var \MamuzContentManager\Entity\Page | \Mockery\MockInterface */
    protected $entity;

    protected function setUp()
    {
        $this->entity = \Mockery::mock('MamuzContentManager\Entity\Page');
        $this->mapper = \Mockery::mock('MamuzContentManager\Feature\QueryInterface');

        $this->fixture = new Query($this->mapper);
    }

    public function testImplementingQueryInterface()
    {
        $this->assertInstanceOf('MamuzContentManager\Feature\QueryInterface', $this->fixture);
    }

    public function testFindActivePageByPath()
    {
        $path = 'foo';
        $this->mapper
            ->shouldReceive('findActivePageByPath')
            ->with($path)
            ->andReturn($this->entity);

        $this->assertSame($this->entity, $this->fixture->findActivePageByPath($path));
    }
}
