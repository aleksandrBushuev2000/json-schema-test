<?php

namespace AleksandrBushuev\Schema\Tests\Builder;

use AleksandrBushuev\Schema\Builder\StringBuilder;
use PHPUnit\Framework\TestCase;

class StringBuilderTest extends TestCase
{
    /**
     * @param StringBuilder $builder
     * @param mixed $input
     * @param bool $expected
     * @dataProvider correctWorkProvider
     */
    public function testCorrectWork(StringBuilder $builder, $input, bool $expected) {
        $type = $builder->getType();
        self::assertEquals($expected, $type->check($input)->isSuccess());
    }

    public function correctWorkProvider() {
        return [
            [
                (new StringBuilder())->max(15)->min(5),
                "55555",
                true
            ],
            [
                (new StringBuilder())->min(10),
                "999999999",
                false
            ],
            [
                (new StringBuilder())->max(350)->regex("/^3/")->regex("/3$/"),
                "353",
                true
            ],
            [
                (new StringBuilder())->max(50)->regex("/^3/")->regex("/3$/"),
                "33333333333333444444444444555",
                false
            ],
        ];
    }
}
