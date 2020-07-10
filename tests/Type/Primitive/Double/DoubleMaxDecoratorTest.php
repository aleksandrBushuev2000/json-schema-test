<?php

namespace AleksandrBushuev\Schema\Tests\Type\Primitive\Double;

use AleksandrBushuev\Schema\CheckResult;
use AleksandrBushuev\Schema\Type\Primitive\Double\DoubleMaxDecorator;
use AleksandrBushuev\Schema\Type\Primitive\Double\DoubleType;
use AleksandrBushuev\Schema\Type\Primitive\String\StringType;
use AleksandrBushuev\Schema\Visitor\IVisitor;
use PHPUnit\Framework\TestCase;

use Exception;

class DoubleMaxDecoratorTest extends TestCase
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

        $deco = new DoubleMaxDecorator($stub, $range);
        self::assertEquals($expected, $deco->check($input)->isSuccess());
    }

    public function checkProvider() {
        return [
            [4.4444, 4.45, true],
            [-32, -31, true],
            [44, 32, false],
            [-1, -1, true],
        ];
    }
}
