<?php

namespace AleksandrBushuev\Schema\Tests;

use AleksandrBushuev\Schema\Builder\ArrayBuilder;
use AleksandrBushuev\Schema\Builder\BoolBuilder;
use AleksandrBushuev\Schema\Builder\DoubleBuilder;
use AleksandrBushuev\Schema\Builder\FieldBuilder;
use AleksandrBushuev\Schema\Builder\IntBuilder;
use AleksandrBushuev\Schema\Builder\ObjectBuilder;
use AleksandrBushuev\Schema\Builder\StringBuilder;
use AleksandrBushuev\Schema\Factory;
use AleksandrBushuev\Schema\Type\Object\SchemaObject;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    private Factory $factory;

    public function setUp(): void {
        parent::setUp();
        $this->factory = new Factory();
    }

    public function testBool() {
        self::assertInstanceOf(BoolBuilder::class, $this->factory->bool());
    }

    public function testString() {
        self::assertInstanceOf(StringBuilder::class, $this->factory->string());
    }

    public function testField() {
        $stub = self::createStub(ObjectBuilder::class);
        $stub->method("getType")->willReturn(self::createStub(SchemaObject::class));
        self::assertInstanceOf(FieldBuilder::class, $this->factory->field("44", $stub));
    }

    public function testArray() {
        $stub = self::createStub(ObjectBuilder::class);
        $stub->method("getType")->willReturn(self::createStub(SchemaObject::class));
        self::assertInstanceOf(ArrayBuilder::class, $this->factory->array($stub));
    }

    public function testDouble() {
        self::assertInstanceOf(DoubleBuilder::class, $this->factory->double());
    }

    public function testInt() {
        self::assertInstanceOf(IntBuilder::class, $this->factory->int());
    }

    public function testObject() {
        self::assertInstanceOf(ObjectBuilder::class, $this->factory->object([]));
    }
}
