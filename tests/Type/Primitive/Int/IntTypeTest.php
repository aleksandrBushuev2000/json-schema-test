<?php

namespace AleksandrBushuev\Schema\Tests\Type\Primitive\Int;

use AleksandrBushuev\Schema\Type\Primitive\Int\IntType;
use PHPUnit\Framework\TestCase;

use stdClass;

class IntTypeTest extends TestCase
{

    /**
     * @param mixed $input
     * @param bool $expected
     * @dataProvider checkProvider
    */
    public function testCheck($input, bool $expected) {
        $t = new IntType();
        self::assertEquals($expected, $t->check($input)->isSuccess());
    }

    public function checkProvider() {
        return [
            [null, false],
            [11.11, false],
            [1, true],
            [-5, true],
            [new stdClass(), false],
            [false, false],
            [[], false]
        ];
    }
}
