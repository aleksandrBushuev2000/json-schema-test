<?php

namespace AleksandrBushuev\Schema\Tests\Type\Object;

use AleksandrBushuev\Schema\Type\Object\SchemaObject;
use PHPUnit\Framework\TestCase;

use stdClass;

class SchemaObjectTest extends TestCase
{

    /**
     * @param mixed $input
     * @param bool $expected
     * @dataProvider checkProvider
    */
    public function testCheck($input, bool $expected) {
        $obj = new SchemaObject([]);
        self::assertEquals($expected, $obj->check($input)->isSuccess());
    }

    public function checkProvider() {
        return [
            [null, false],
            [true, false],
            [new stdClass(), true],
            [["key" => "value"], true],
            [[], true],
            [6, false],
            ["string", false]
        ];
    }
}
