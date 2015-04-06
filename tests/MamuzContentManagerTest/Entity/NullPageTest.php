<?php

namespace MamuzContentManagerTest\Entity;

use MamuzContentManager\Entity\NullPage;

class NullPageTest extends \PHPUnit_Framework_TestCase
{
    /** @var NullPage */
    protected $fixture;

    protected function setUp()
    {
        $this->fixture = new NullPage;
    }

    public function testExtendingPage()
    {
        $this->assertInstanceOf('MamuzContentManager\Entity\Page', $this->fixture);
    }

    public function testTitleAccess()
    {
        $this->assertSame('Error', $this->fixture->getTitle());
    }

    public function testContentAccess()
    {
        $this->assertSame('Page not found', $this->fixture->getContent());
    }

    public function testDescriptionAccess()
    {
        $this->assertSame('', $this->fixture->getDescription());
    }
}
