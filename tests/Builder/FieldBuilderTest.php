<?php

namespace AleksandrBushuev\Schema\Tests\Builder;

use AleksandrBushuev\Schema\Builder\FieldBuilder;
use AleksandrBushuev\Schema\Builder\StringBuilder;
use AleksandrBushuev\Schema\Type\Primitive\String\StringType;
use PHPUnit\Framework\TestCase;

class FieldBuilderTest extends TestCase
{
    private string $key = "key";

    /**
     * @param FieldBuilder $builder
     * @param mixed $input
     * @param array $expected
     * @dataProvider provider
    */
    public function testCorrectWork(FieldBuilder $builder, $input, array $expected) {
        $obj = $builder->getType();

        self::assertEquals($expected['result'], $obj->check($input)->isSuccess());
        self::assertEquals($expected["required"], $obj->getRequired());
        self::assertEquals($expected["default"], $obj->getDefaultValue());
    }

    public function provider() {
        $stringTypeStub = self::createStub(StringType::class);
        $fieldValueStub = self::createStub(StringBuilder::class);
        $fieldValueStub->method("getType")->willReturn($stringTypeStub);
        $key = $this->key;
        return [
            [
                (new FieldBuilder($key, $fieldValueStub)),
                ["key" => "value"],
                ["result" => true, "required" => true, "default" => null],
            ],
            [
                (new FieldBuilder($key, $fieldValueStub))
                    ->required(false)
                    ->defaultValue("str"),

                ["key" => "15"],
                ["result" => true, "required" => false, "default" => "str"]
            ],
            [
                (new FieldBuilder($key, $fieldValueStub))
                    ->required(false)
                    ->defaultValue(false),
                [1, 2, 4, 5, 6],
                ["result" => false, "required" => false, "default" => false]
            ],
        ];
    }
}
