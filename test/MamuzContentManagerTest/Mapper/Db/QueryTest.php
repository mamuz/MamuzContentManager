<?php

namespace MamuzContentManagerTest\Mapper\Db;

use MamuzContentManager\Mapper\Db\Query;

class QueryTest extends \PHPUnit_Framework_TestCase
{
    /** @var Query */
    protected $fixture;

    /** @var \Doctrine\Common\Persistence\ObjectRepository | \Mockery\MockInterface */
    protected $entityRepository;

    /** @var \MamuzContentManager\Entity\Page | \Mockery\MockInterface */
    protected $entity;

    protected function setUp()
    {
        $this->entity = \Mockery::mock('MamuzContentManager\Entity\Page');
        $this->entityRepository = \Mockery::mock('Doctrine\Common\Persistence\ObjectRepository');

        $this->fixture = new Query($this->entityRepository);
    }

    public function testImplementingQueryInterface()
    {
        $this->assertInstanceOf('MamuzContentManager\Feature\QueryInterface', $this->fixture);
    }

    public function testFindPublishedPageByPath()
    {
        $path = 'foo';
        $this->entityRepository
            ->shouldReceive('findOneBy')
            ->with(
                array(
                    'path'   => $path,
                    'published' => true,
                )
            )
            ->andReturn($this->entity);

        $this->assertSame($this->entity, $this->fixture->findPublishedPageByPath($path));
    }

    public function testFindPublishedPageByPathWithNullPage()
    {
        $path = 'foo';
        $this->entityRepository
            ->shouldReceive('findOneBy')
            ->with(
                array(
                    'path'   => $path,
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
