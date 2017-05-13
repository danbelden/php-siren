<?php

namespace Tests\Siren;

use Siren\Document;
use Siren\Entity;
use Siren\Action;
use Siren\Link;
use PHPUnit\Framework\TestCase;
use LogicException;

class DocumentTest extends TestCase
{
    public function testClassGetAndSet()
    {
        $document = new Document();

        $newClass = array('new');
        $nowClass = $document->getClass();
        $this->assertNotEquals($newClass, $nowClass);

        $document->setClass($newClass);
        $updatedClass = $document->getClass();
        $this->assertEquals($newClass, $updatedClass);
    }

    /**
     * @expectedException LogicException
     * @expectedExceptionMessage Provided class `1` is not a string
     */
    public function testSetClassThrowsAnExceptionIfANonStringSetItemIsProvided()
    {
        $newClass = array(1);

        $document = new Document();
        $document->setClass($newClass);
    }

    public function testAddClassAppendsToClassArray()
    {
        $document     = new Document();
        $currentClass = $document->getClass();
        $this->assertEquals([], $currentClass);

        $document->addClass('test');
        $updatedClass = $document->getClass();
        $this->assertEquals([ 'test' ], $updatedClass);
    }

    /**
     * @expectedException LogicException
     * @expectedExceptionMessage Provided class `1` is not a string
     */
    public function testAddClassThrowsAnExceptionIfANonStringSetItemIsProvided()
    {
        $document = new Document();
        $document->addClass(1);
    }

    public function testPropertiesGetAndSet()
    {
        $document          = new Document();
        $newProperties     = array('A' => 'TEST');
        $initialProperties = $document->getProperties();
        $this->assertNotEquals($newProperties, $initialProperties);

        $document->setProperties($newProperties);
        $nowProperties = $document->getProperties();
        $this->assertEquals($newProperties, $nowProperties);
    }

    public function testAddPropertyAppendsToSet()
    {
        $document = new Document();

        $currentProperties = $document->getProperties();
        $this->assertEmpty($currentProperties);

        $document->addProperty('B', 'TEST');
        $properties = $document->getProperties();
        $this->assertArrayHasKey('B', $properties);
    }

    public function testEntitiesGetAndSet()
    {
        $document        = new Document();
        $newEntities     = array(new Entity());
        $initialEntities = $document->getEntities();
        $this->assertNotEquals($newEntities, $initialEntities);

        $document->setEntities($newEntities);
        $nowEntities = $document->getEntities();
        $this->assertEquals($newEntities, $nowEntities);
    }

    /**
     * @expectedException LogicException
     * @expectedExceptionMessage Array key `1` is not an instance of Entity
     */
    public function testSetEntitiesThrowsAnExceptionWithNonEntityInSet()
    {
        $document    = new Document();
        $newEntities = array(new Entity(), 1);
        $document->setEntities($newEntities);
    }

    public function testAddEntityAppendsToSet()
    {
        $document = new Document();

        $currentEntities = $document->getEntities();
        $this->assertEmpty($currentEntities);

        $entity = new Entity();
        $document->addEntity($entity);

        $entities = $document->getEntities();
        $this->assertCount(1, $entities);

        $firstEntity = array_shift($entities);
        $this->assertEquals($entity, $firstEntity);
    }

    public function testActionsGetAndSet()
    {
        $document       = new Document();
        $newActions     = array(new Action());
        $initialActions = $document->getActions();
        $this->assertNotEquals($newActions, $initialActions);

        $document->setActions($newActions);
        $nowActions = $document->getActions();
        $this->assertEquals($newActions, $nowActions);
    }

    /**
     * @expectedException LogicException
     * @expectedExceptionMessage Array key `1` is not an instance of Action
     */
    public function testSetActionsThrowsAnExceptionWithNonActionInSet()
    {
        $document   = new Document();
        $newActions = array(new Action(), 1);
        $document->setActions($newActions);
    }

    public function testAddActionAppendsToSet()
    {
        $document = new Document();

        $currentActions = $document->getActions();
        $this->assertEmpty($currentActions);

        $action = new Action();
        $document->addAction($action);

        $actions = $document->getActions();
        $this->assertCount(1, $actions);

        $firstAction = array_shift($actions);
        $this->assertEquals($action, $firstAction);
    }

    public function testLinksGetAndSet()
    {
        $document     = new Document();
        $newLinks     = array(new Link());
        $initialLinks = $document->getLinks();
        $this->assertNotEquals($newLinks, $initialLinks);

        $document->setLinks($newLinks);
        $nowLinks = $document->getLinks();
        $this->assertEquals($newLinks, $nowLinks);
    }

    /**
     * @expectedException LogicException
     * @expectedExceptionMessage Array key `1` is not an instance of Link
     */
    public function testSetLinksThrowsAnExceptionWithNonLinkInSet()
    {
        $document = new Document();
        $newLinks = array(new Link(), 1);
        $document->setLinks($newLinks);
    }

    public function testAddLinkAppendsToSet()
    {
        $document = new Document();

        $currentLinks = $document->getLinks();
        $this->assertEmpty($currentLinks);

        $link = new Link();
        $document->addLink($link);

        $links = $document->getLinks();
        $this->assertCount(1, $links);

        $firstLink = array_shift($links);
        $this->assertEquals($link, $firstLink);
    }
}
