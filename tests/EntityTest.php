<?php

namespace Tests\Siren;

use Siren\Entity;
use Siren\Link;
use PHPUnit\Framework\TestCase;
use LogicException;

class EntityTest extends TestCase
{
    public function testClassGetAndSet()
    {
        $entity = new Entity();

        $newClass = [ 'new' ];
        $nowClass = $entity->getClass();
        $this->assertNotEquals($newClass, $nowClass);

        $entity->setClass($newClass);
        $updatedClass = $entity->getClass();
        $this->assertEquals($newClass, $updatedClass);
    }

    /**
     * @expectedException LogicException
     * @expectedExceptionMessage Provided class `1` is not a string
     */
    public function testSetClassThrowsAnExceptionIfANonStringSetItemIsProvided()
    {
        $entity = new Entity();
        $entity->setClass([ 1 ]);
    }

    public function testAddClassAppendsToClassArray()
    {
        $entity       = new Entity();
        $currentClass = $entity->getClass();
        $this->assertEquals([], $currentClass);

        $entity->addClass('test');
        $updatedClass = $entity->getClass();
        $this->assertEquals([ 'test' ], $updatedClass);
    }

    public function testRelGetAndSet()
    {
        $entity = new Entity();

        $newRel = [ 'new' ];
        $nowRel = $entity->getRel();
        $this->assertNotEquals($newRel, $nowRel);

        $entity->setRel($newRel);
        $updatedRel = $entity->getRel();
        $this->assertEquals($newRel, $updatedRel);
    }

    /**
     * @expectedException LogicException
     * @expectedExceptionMessage Provided rel `1` is not a string
     */
    public function testSetRelThrowsAnExceptionIfANonStringSetItemIsProvided()
    {
        $entity = new Entity();
        $entity->setRel([ 1 ]);
    }

    public function testAddRelAppendsToRelArray()
    {
        $entity     = new Entity();
        $currentRel = $entity->getRel();
        $this->assertEquals([], $currentRel);

        $entity->addRel('test');
        $updatedRel = $entity->getRel();
        $this->assertEquals([ 'test' ], $updatedRel);
    }

    public function testHrefGetAndSet()
    {
        $entity = new Entity();

        $newHref = 'new' ;
        $nowHref = $entity->getHref();
        $this->assertNotEquals($newHref, $nowHref);

        $entity->setHref($newHref);
        $updatedHref = $entity->getHref();
        $this->assertEquals($newHref, $updatedHref);
    }

    /**
     * @expectedException LogicException
     * @expectedExceptionMessage Provided href `1` is not a string
     */
    public function testSetHrefThrowsAnExceptionIfANonStringProvided()
    {
        $entity = new Entity();
        $entity->setHref(1);
    }

    public function testPropertiesGetAndSet()
    {
        $entity            = new Entity();
        $newProperties     = [ 'A' => 'TEST' ];
        $initialProperties = $entity->getProperties();
        $this->assertNotEquals($newProperties, $initialProperties);

        $entity->setProperties($newProperties);
        $nowProperties = $entity->getProperties();
        $this->assertEquals($newProperties, $nowProperties);
    }

    public function testAddPropertyAppendsToSet()
    {
        $entity = new Entity();

        $currentProperties = $entity->getProperties();
        $this->assertEmpty($currentProperties);

        $entity->addProperty('B', 'TEST');
        $properties = $entity->getProperties();
        $this->assertArrayHasKey('B', $properties);
    }

    public function testLinksGetAndSet()
    {
        $entity       = new Entity();
        $newLinks     = [ new Link() ];
        $initialLinks = $entity->getLinks();
        $this->assertNotEquals($newLinks, $initialLinks);

        $entity->setLinks($newLinks);
        $nowLinks = $entity->getLinks();
        $this->assertEquals($newLinks, $nowLinks);
    }

    /**
     * @expectedException LogicException
     * @expectedExceptionMessage Array key `1` is not an instance of Link
     */
    public function testSetLinksThrowsAnExceptionWithNonLinkInSet()
    {
        $entity   = new Entity();
        $newLinks = [ new Link(), 1 ];
        $entity->setLinks($newLinks);
    }

    public function testAddLinkAppendsToSet()
    {
        $entity = new Entity();

        $currentLinks = $entity->getLinks();
        $this->assertEmpty($currentLinks);

        $link = new Link();
        $entity->addLink($link);

        $links = $entity->getLinks();
        $this->assertCount(1, $links);

        $firstLink = array_shift($links);
        $this->assertEquals($link, $firstLink);
    }
}
