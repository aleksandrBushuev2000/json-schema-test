<?php

namespace AleksandrBushuev\Schema\Tests\Type\Arr;

use AleksandrBushuev\Schema\CheckResult;
use AleksandrBushuev\Schema\Type\Arr\ArrayType;
use AleksandrBushuev\Schema\Type\ISchemaType;
use AleksandrBushuev\Schema\Visitor\IVisitor;
use PHPUnit\Framework\TestCase;

use stdClass;

class ArrayTypeTest extends TestCase
{

    /**
     * @param bool $expected
     * @param mixed $input
     * @dataProvider checkProvider
    */
    public function testCheck($input, bool $expected) {
        $schemaType = new class implements ISchemaType {
            public function accept(IVisitor $visitor, $input) {}
            public function check($input): CheckResult {
                return new CheckResult(true);
            }
        };

        $arr = new ArrayType($schemaType);

        $res = $arr->check($input);

        self::assertEquals($expected, $res->isSuccess());
    }

    public function checkProvider() {
        return [
            [new stdClass(), false],
            [[], true],
            [["one" => 1], false],
            ["stupid string", false],
            [null, false],
            [[1, 2, 3, 4, 5, 6], true]
        ];
    }
}
