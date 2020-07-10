<?php

namespace AleksandrBushuev\Schema\Tests\Builder;

use AleksandrBushuev\Schema\Builder\IntBuilder;
use PHPUnit\Framework\TestCase;


class IntBuilderTest extends TestCase
{

    /**
     * @param IntBuilder $builder
     * @param mixed $input
     * @param bool $expected
     * @dataProvider correctWorkProvider
     */
    public function testCorrectWork(IntBuilder $builder, $input, bool $expected) {
        $type = $builder->getType();
        self::assertEquals($expected, $type->check($input)->isSuccess());
    }

    public function correctWorkProvider() {
        return [
            [
                (new IntBuilder())->max(15.53)->min(0),
                -1,
                false
            ],
            [
                (new IntBuilder())->min(-100),
                -100,
                true
            ],
            [
                (new IntBuilder())->max(350),
                350,
                true
            ],
            [
                (new IntBuilder()),
                155,
                true
            ],
            [
                (new IntBuilder())->max(42),
                "Str",
                false
            ],
        ];
    }
}
