<?php

namespace AleksandrBushuev\Schema\Tests\Type\Primitive\Double;

use AleksandrBushuev\Schema\CheckResult;
use AleksandrBushuev\Schema\Type\Primitive\Double\DoubleMinDecorator;
use AleksandrBushuev\Schema\Type\Primitive\Double\DoubleType;
use PHPUnit\Framework\TestCase;

class DoubleMinDecoratorTest extends TestCase
{

    /**
     * @param float $input
     * @param float $range
     * @param bool $expected
     * @dataProvider checkProvider
     */
    public function testCheckRange(float $input, float $range, bool $expected) {
        $stub = $this->createStub(DoubleType::class);
        $stub->method("check")->willReturn(new CheckResult(true));

        $deco = new DoubleMinDecorator($stub, $range);
        self::assertEquals($expected, $deco->check($input)->isSuccess());
    }

    public function checkProvider() {
        return [
            [4.4444, 4.45, false],
            [-32, -31, false],
            [44, 32, true],
            [-1, -1, true],
        ];
    }
}
