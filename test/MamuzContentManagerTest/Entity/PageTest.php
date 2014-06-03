<?php

namespace MamuzContentManagerTest\Entity;

use MamuzContentManager\Entity\Page;

class PageTest extends \PHPUnit_Framework_TestCase
{
    /** @var Page */
    protected $fixture;

    protected function setUp()
    {
        $this->fixture = new Page;
    }

    public function testClone()
    {
        $this->fixture->setId(12);
        $this->fixture->setPath('foo');
        $clone = clone $this->fixture;

        $this->assertNull($clone->getId());
        $this->assertNull($clone->getPath());
    }

    public function testMutateAndAccessId()
    {
        $expected = 12;
        $this->assertNull($this->fixture->getId());
        $result = $this->fixture->setId($expected);
        $this->assertSame($expected, $this->fixture->getId());
        $this->assertSame($result, $this->fixture);
    }

    public function testMutateAndAccessPath()
    {
        $expected = 'foo';
        $this->assertNull($this->fixture->getPath());
        $result = $this->fixture->setPath($expected);
        $this->assertSame($expected, $this->fixture->getPath());
        $this->assertSame($result, $this->fixture);
    }

    public function testMutateAndAccessTitle()
    {
        $expected = 'foo';
        $this->assertSame('', $this->fixture->getTitle());
        $result = $this->fixture->setTitle($expected);
        $this->assertSame($expected, $this->fixture->getTitle());
        $this->assertSame($result, $this->fixture);
    }

    public function testMutateAndAccessContent()
    {
        $expected = 'foo';
        $this->assertSame('', $this->fixture->getContent());
        $result = $this->fixture->setContent($expected);
        $this->assertSame($expected, $this->fixture->getContent());
        $this->assertSame($result, $this->fixture);
    }

    public function testMutateAndAccessActive()
    {
        $this->assertFalse($this->fixture->isActive());
        $result = $this->fixture->setActive(true);
        $this->assertTrue($this->fixture->isActive());
        $this->assertSame($result, $this->fixture);
    }
}
