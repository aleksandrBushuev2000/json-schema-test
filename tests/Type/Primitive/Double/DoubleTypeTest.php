<?php

namespace AleksandrBushuev\Schema\Tests\Type\Primitive\Double;

use AleksandrBushuev\Schema\Type\Primitive\Double\DoubleType;
use PHPUnit\Framework\TestCase;

use stdClass;

class DoubleTypeTest extends TestCase
{

    /**
     * @param mixed $input
     * @param bool $expected
     * @dataProvider checkProvider
    */
    public function testCheck($input, bool $expected) {
        $t = new DoubleType();
        self::assertEquals($expected, $t->check($input)->isSuccess());
    }

    public function checkProvider() {
        return [
            [null, false],
            [1, true],
            [false, false],
            [[], false],
            [new stdClass(), false],
            [11.43, true]
        ];
    }
}
