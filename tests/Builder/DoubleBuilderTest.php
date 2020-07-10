<?php

namespace AleksandrBushuev\Schema\Tests\Builder;

use AleksandrBushuev\Schema\Builder\DoubleBuilder;
use PHPUnit\Framework\TestCase;


class DoubleBuilderTest extends TestCase
{

    /**
     * @param DoubleBuilder $builder
     * @param mixed $input
     * @param bool $expected
     * @dataProvider correctWorkProvider
    */
    public function testCorrectWork(DoubleBuilder $builder, $input, bool $expected) {
        $type = $builder->getType();
        self::assertEquals($expected, $type->check($input)->isSuccess());
    }

    public function correctWorkProvider() {
        return [
            [
                (new DoubleBuilder())->max(15.53)->min(0),
                15.52,
                true
            ],
            [
                (new DoubleBuilder())->min(-100),
                -100.05,
                false
            ],
            [
                (new DoubleBuilder())->max(350),
                350.4,
                false
            ],
            [
                (new DoubleBuilder()),
                155,
                true
            ],
            [
                (new DoubleBuilder())->max(42),
                "Str",
                false
            ],
        ];
    }
}
