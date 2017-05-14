<?php

namespace Tests\Siren;

use Siren\Action;
use Siren\Document;
use Siren\Entity;
use Siren\Field;
use Siren\Handler;
use Siren\Link;
use PHPUnit\Framework\TestCase;
use LogicException;
use Tests\Siren\Fixtures\FixtureHelper;

class HandlerTest extends TestCase
{
    /**
     * @see https://github.com/kevinswiber/siren#example
     * @return Document
     */
    public function getTestDocument()
    {
        $document = new Document();
        $document->addClass('order');

        $properties = array(
            'orderNumber' => 42,
            'itemCount'   => 3,
            'status'      => 'pending'
        );
        $document->setProperties($properties);

        $entityOne = new Entity();
        $entityOne->setClass(array( 'items', 'collection' ))
            ->setRel(array( 'http://x.io/rels/order-items' ))
            ->setHref('http://api.x.io/orders/42/items');

        $entityTwoLink = new Link();
        $entityTwoLink->setRel(array( 'self' ))
            ->setHref('http://api.x.io/customers/pj123');

        $entityTwo = new Entity();
        $entityTwo->setClass(array( 'info', 'customer' ))
            ->setRel(array( 'http://x.io/rels/customer' ))
            ->setProperties(array(
                'customerId' => 'pj123',
                'name' => 'Peter Joseph'
            ))
            ->setLinks(array( $entityTwoLink ));

        $entities = array( $entityOne, $entityTwo );
        $document->setEntities($entities);

        $actionFieldOne = new Field();
        $actionFieldOne->setName('orderNumber')
            ->setType('hidden')
            ->setValue('42');

        $actionFieldTwo = new Field();
        $actionFieldTwo->setName('productCode')
            ->setType('text');

        $actionFieldThree = new Field();
        $actionFieldThree->setName('quantity')
            ->setType('number');

        $actionOne = new Action();
        $actionOne->setName('add-item')
            ->setTitle('Add Item')
            ->setMethod('POST')
            ->setHref('http://api.x.io/orders/42/items')
            ->setType('application/x-www-form-urlencoded')
            ->setFields(array( $actionFieldOne, $actionFieldTwo, $actionFieldThree ));

        $actions = array( $actionOne );
        $document->setActions($actions);

        $linkOne = new Link();
        $linkOne->setRel(array( 'self' ))
            ->setHref('http://api.x.io/orders/42');

        $linkTwo = new Link();
        $linkTwo->setRel(array( 'previous' ))
            ->setHref('http://api.x.io/orders/41');

        $linkThree = new Link();
        $linkThree->setRel(array( 'next' ))
            ->setHref('http://api.x.io/orders/43');

        $links = array( $linkOne, $linkTwo, $linkThree );
        $document->setLinks($links);

        return array(
            array($document)
        );
    }

    /**
     * @dataProvider getTestDocument
     * @param Document $document
     */
    public function testToJson(Document $document)
    {
        $fixtureHelper  = new FixtureHelper();
        $jsonFixture    = $fixtureHelper->getFixture('example1');
        $expectedObject = json_decode($jsonFixture);

        $handler      = new Handler();
        $json         = $handler->toJson($document);
        $actualObject = json_decode($json);

        $this->assertEquals($expectedObject, $actualObject);
    }

    /**
     * @dataProvider getTestDocument
     * @param Document $expectedDocument
     */
    public function testToDocument(Document $expectedDocument)
    {
        $fixtureHelper = new FixtureHelper();
        $jsonFixture   = $fixtureHelper->getFixture('example1');

        $handler        = new Handler();
        $actualDocument = $handler->toDocument($jsonFixture);

        $this->assertEquals($expectedDocument, $actualDocument);
    }
}
