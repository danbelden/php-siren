<?php

namespace Tests\Siren;

use Siren\Action;
use Siren\Field;
use PHPUnit\Framework\TestCase;
use LogicException;

class ActionTest extends TestCase
{
    public function testNameGetAndSet()
    {
        $action = new Action();

        $newName = 'test';
        $nowName = $action->getName();
        $this->assertNotEquals($newName, $nowName);

        $action->setName($newName);
        $updatedName = $action->getName();
        $this->assertEquals($newName, $updatedName);
    }

    /**
     * @expectedException LogicException
     * @expectedExceptionMessage Provided name `1` is not a string
     */
    public function testSetNameThrowsAnExceptionIfANonStringNameIsProvided()
    {
        $action = new Action();
        $action->setName(1);
    }

    public function testTitleGetAndSet()
    {
        $action = new Action();

        $newTitle = 'test';
        $nowTitle = $action->getTitle();
        $this->assertNotEquals($newTitle, $nowTitle);

        $action->setTitle($newTitle);
        $updatedTitle = $action->getTitle();
        $this->assertEquals($newTitle, $updatedTitle);
    }

    /**
     * @expectedException LogicException
     * @expectedExceptionMessage Provided title `1` is not a string
     */
    public function testSetTitleThrowsAnExceptionIfANonStringTitleIsProvided()
    {
        $action = new Action();
        $action->setTitle(1);
    }

    public function testMethodGetAndSet()
    {
        $action = new Action();

        $newMethod = 'test';
        $nowMethod = $action->getMethod();
        $this->assertNotEquals($newMethod, $nowMethod);

        $action->setMethod($newMethod);
        $updatedMethod = $action->getMethod();
        $this->assertEquals($newMethod, $updatedMethod);
    }

    /**
     * @expectedException LogicException
     * @expectedExceptionMessage Provided method `1` is not a string
     */
    public function testSetMethodThrowsAnExceptionIfANonStringMethodIsProvided()
    {
        $action = new Action();
        $action->setMethod(1);
    }

    public function testHrefGetAndSet()
    {
        $action = new Action();

        $newHref = 'test';
        $nowHref = $action->getHref();
        $this->assertNotEquals($newHref, $nowHref);

        $action->setHref($newHref);
        $updatedHref = $action->getHref();
        $this->assertEquals($newHref, $updatedHref);
    }

    /**
     * @expectedException LogicException
     * @expectedExceptionMessage Provided href `1` is not a string
     */
    public function testSetHrefThrowsAnExceptionIfANonStringHrefIsProvided()
    {
        $action = new Action();
        $action->setHref(1);
    }

    public function testTypeGetAndSet()
    {
        $action = new Action();

        $newType = 'test';
        $nowType = $action->getType();
        $this->assertNotEquals($newType, $nowType);

        $action->setType($newType);
        $updatedType = $action->getType();
        $this->assertEquals($newType, $updatedType);
    }

    /**
     * @expectedException LogicException
     * @expectedExceptionMessage Provided type `1` is not a string
     */
    public function testSetTypeThrowsAnExceptionIfANonStringTypeIsProvided()
    {
        $action = new Action();
        $action->setType(1);
    }

    public function testFieldsGetAndSet()
    {
        $action = new Action();

        $newFields = [ new Field() ];
        $nowFields = $action->getFields();
        $this->assertNotEquals($newFields, $nowFields);

        $action->setFields($newFields);
        $updatedFields = $action->getFields();
        $this->assertEquals($newFields, $updatedFields);
    }

    /**
     * @expectedException LogicException
     * @expectedExceptionMessage Array key `1` is not an instance of Field
     */
    public function testFieldsThrowsAnExceptionIfNoneFieldInSet()
    {
        $newFields = [ new Field(), 1 ];

        $action = new Action();
        $action->setFields($newFields);
    }
}
