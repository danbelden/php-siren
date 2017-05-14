<?php

namespace Tests\Siren;

use Siren\Field;
use PHPUnit\Framework\TestCase;
use LogicException;

class FieldTest extends TestCase
{
    public function testNameGetAndSet()
    {
        $field = new Field();

        $newName = 'test';
        $nowName = $field->getName();
        $this->assertNotEquals($newName, $nowName);

        $field->setName($newName);
        $updatedName = $field->getName();
        $this->assertEquals($newName, $updatedName);
    }

    /**
     * @expectedException LogicException
     * @expectedExceptionMessage Provided name `1` is not a string
     */
    public function testSetNameThrowsAnExceptionIfANonStringNameIsProvided()
    {
        $field = new Field();
        $field->setName(1);
    }

    public function testTypeGetAndSet()
    {
        $field = new Field();

        $newType = 'test';
        $nowType = $field->getType();
        $this->assertNotEquals($newType, $nowType);

        $field->setType($newType);
        $updatedType = $field->getType();
        $this->assertEquals($newType, $updatedType);
    }

    /**
     * @expectedException LogicException
     * @expectedExceptionMessage Provided type `1` is not a string
     */
    public function testSetTypeThrowsAnExceptionIfANonStringTypeIsProvided()
    {
        $field = new Field();
        $field->setType(1);
    }

    public function testValueGetAndSet()
    {
        $field = new Field();

        $newValue = 'test';
        $nowValue = $field->getValue();
        $this->assertNotEquals($newValue, $nowValue);

        $field->setValue($newValue);
        $updatedValue = $field->getValue();
        $this->assertEquals($newValue, $updatedValue);
    }

    public function testToArray()
    {
        $expexctedArray = array(
            'name'  => 'orderNumber' ,
            'type'  => 'hidden',
            'value' => '42'
        );

        $field = new Field();
        $field->setName('orderNumber')
            ->setType('hidden')
            ->setValue('42');
        $actualArray = $field->toArray();

        $this->assertEquals($expexctedArray, $actualArray);
    }
}
