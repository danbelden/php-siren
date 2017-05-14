<?php

namespace Tests\Siren;

use Siren\Action;
use Siren\Document;
use Siren\Entity;
use Siren\Field;
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
        $this->assertEquals(array(), $currentClass);

        $document->addClass('test');
        $updatedClass = $document->getClass();
        $this->assertEquals(array('test'), $updatedClass);
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

    public function testToArray()
    {
        $expexctedArray = array(
            'class' => array('order'),
            'properties' => array(
                'orderNumber' => 42,
                'itemCount'   => 3,
                'status'      => 'pending'
            ),
            'entities' => array(
                array(
                    'class'      => array('info', 'customer'),
                    'rel'        => array('http://x.io/rels/customer'),
                    'properties' => array(
                        'customerId' => 'pj123',
                        'name'       => 'Peter Joseph'
                    ),
                    'links'      => array(
                        array(
                            'rel'  => array('self'),
                            'href' => 'http://api.x.io/customers/pj123'
                        )
                    )
                )
            ),
            'actions' => array(
                array(
                    'name'   => 'add-item',
                    'title'  => 'Add Item',
                    'method' => 'POST',
                    'href'   => 'http://api.x.io/orders/42/items',
                    'type'   => 'application/x-www-form-urlencoded',
                    'fields' => array(
                        array(
                            'name'  => 'orderNumber',
                            'type'  => 'hidden',
                            'value' => '42',
                        )
                    )
                )
            ),
            'links' => array(
                array(
                    'rel'  => array('self'),
                    'href' => 'http://api.x.io/orders/42'
                )
            )
        );

        $document = new Document();
        $document->addClass('order');

        $properties = array(
            'orderNumber' => 42,
            'itemCount'   => 3,
            'status'      => 'pending'
        );
        $document->setProperties($properties);

        $entityOneLink = new Link();
        $entityOneLink->setRel(array( 'self' ))
            ->setHref('http://api.x.io/customers/pj123');

        $entityOne = new Entity();
        $entityOne->setClass(array( 'info', 'customer' ))
            ->setRel(array( 'http://x.io/rels/customer' ))
            ->setProperties(array(
                'customerId' => 'pj123',
                'name' => 'Peter Joseph'
            ))
            ->setLinks(array( $entityOneLink ));

        $entities = array( $entityOne );
        $document->setEntities($entities);

        $actionFieldOne = new Field();
        $actionFieldOne->setName('orderNumber')
            ->setType('hidden')
            ->setValue('42');

        $actionOne = new Action();
        $actionOne->setName('add-item')
            ->setTitle('Add Item')
            ->setMethod('POST')
            ->setHref('http://api.x.io/orders/42/items')
            ->setType('application/x-www-form-urlencoded')
            ->setFields(array( $actionFieldOne ));

        $actions = array( $actionOne );
        $document->setActions($actions);

        $linkOne = new Link();
        $linkOne->setRel(array( 'self' ))
            ->setHref('http://api.x.io/orders/42');

        $links = array( $linkOne );
        $document->setLinks($links);

        $actualArray = $document->toArray();

        $this->assertEquals($expexctedArray, $actualArray);
    }
}
