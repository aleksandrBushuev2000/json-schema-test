<?php

namespace AleksandrBushuev\Schema\Tests\Builder;


use AleksandrBushuev\Schema\Builder\ObjectBuilder;
use AleksandrBushuev\Schema\Builder\StringBuilder;
use AleksandrBushuev\Schema\Type\Object\SchemaObject;
use AleksandrBushuev\Schema\Type\Primitive\String\StringType;
use PHPUnit\Framework\TestCase;

class ObjectBuilderTest extends TestCase
{
    public function testCorrectWork() {

        $nestedBuilders = [
            self::createStub(StringBuilder::class)
        ];

        $nestedBuilders[0]
            ->method("getType")
            ->willReturn(self::createStub(StringType::class));

        $testBuilder = new ObjectBuilder($nestedBuilders);

        self::assertInstanceOf(SchemaObject::class, $testBuilder->getType());

    }

}
