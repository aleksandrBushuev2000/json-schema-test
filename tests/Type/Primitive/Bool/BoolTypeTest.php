<?php

namespace AleksandrBushuev\Schema\Tests\Type\Primitive\Bool;

use AleksandrBushuev\Schema\Type\Primitive\Bool\BoolType;
use PHPUnit\Framework\TestCase;

class BoolTypeTest extends TestCase
{

    /**
     * @dataProvider checkProvider
     * @param mixed $input
     * @param bool $expected
    */
    public function testCheck($input, bool $expected) {
        $type = new BoolType();
        self::assertEquals($expected, $type->check($input)->isSuccess());
    }

    public function checkProvider() {
        return [
            [true, true],
            [false, true],
            ["true", false],
            [0, false],
            [32, false],
            [[], false],
        ];
    }
}
