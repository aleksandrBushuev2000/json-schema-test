<?php

namespace AleksandrBushuev\Schema\Tests\Type\ObjectField;

use AleksandrBushuev\Schema\CheckResult;
use AleksandrBushuev\Schema\Type\ObjectField\ObjectField;
use AleksandrBushuev\Schema\Type\Primitive\String\StringType;
use PHPUnit\Framework\TestCase;

use stdClass;

class ObjectFieldTest extends TestCase
{
    private string $key = "key";

    /**
     * @param  array|stdClass $input
     * @param bool $expected
     * @dataProvider checkProvider
    */
    public function testCheck($input, bool $expected) {
        $stub = $this->createStub(StringType::class);
        $stub->method("check")->willReturn(new CheckResult(true));
        $field = new ObjectField($this->key, $stub);
        self::assertEquals($expected, $field->check($input)->isSuccess());
    }

    public function checkProvider() {
        $key = $this->key;
        $class = new stdClass();
        $class->$key = "value";
        return [
            [[$key => "value"], true],
            [$class, true],
            [new stdClass(), false],
            [["value" => $key], false],
        ];
    }


}
