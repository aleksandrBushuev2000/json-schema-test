<?php

namespace AleksandrBushuev\Schema\Tests\Builder;

use AleksandrBushuev\Schema\Builder\ArrayBuilder;
use AleksandrBushuev\Schema\Builder\StringBuilder;
use AleksandrBushuev\Schema\Type\Primitive\String\StringType;
use PHPUnit\Framework\TestCase;

class ArrayBuilderTest extends TestCase
{
    /**
     * @param ArrayBuilder $builder
     * @param mixed $input
     * @param bool $expected
     * @dataProvider correctWorkProvider
    */
    public function testCorrectWork(ArrayBuilder $builder, $input, bool $expected) {
        $type = $builder->getType();
        self::assertEquals($expected, $type->check($input)->isSuccess());
    }

    public function correctWorkProvider() {
        $childStub = self::createStub(StringBuilder::class);
        $childStub->method("getType")->willReturn(
            self::createStub(StringType::class)
        );

        return [
            [
                (new ArrayBuilder($childStub))->max(5)->min(5),
                [1,1,1,1,1],
                true
            ],
            [
                (new ArrayBuilder($childStub))->max(10),
                [1,1,1,1,1,1,1,1,1,1],
                true
            ],
            [
                (new ArrayBuilder($childStub)),
                ["32" => 54],
                false
            ],
            [
                (new ArrayBuilder($childStub))->max(5)->min(5),
                [6,6,6,6,6,6,6],
                false
            ],
        ];
    }
}
