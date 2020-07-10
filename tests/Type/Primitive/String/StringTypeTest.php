<?php

namespace AleksandrBushuev\Schema\Tests\Type\Primitive\String;

use AleksandrBushuev\Schema\Type\Primitive\String\StringType;
use PHPUnit\Framework\TestCase;

use stdClass;

class StringTypeTest extends TestCase
{
    /**
     * @dataProvider correctWorkProvider
    */
    public function testCorrectWork($input, bool $expected) {
        $str = new StringType();
        self::assertEquals($expected, $str->check($input)->isSuccess());
    }

    public function correctWorkProvider() {
        return [
            ["", true],
            ["string", true],
            [new stdClass(), false],
            [true, false],
            [null, false],
            [[], false]
        ];
    }
}
