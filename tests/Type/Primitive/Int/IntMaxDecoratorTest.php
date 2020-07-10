<?php

namespace AleksandrBushuev\Schema\Tests\Type\Primitive\Int;

use AleksandrBushuev\Schema\CheckResult;
use AleksandrBushuev\Schema\Type\Primitive\Int\IntType;
use AleksandrBushuev\Schema\Type\Primitive\Int\IntMaxDecorator;
use PHPUnit\Framework\TestCase;

class IntMaxDecoratorTest extends TestCase
{

    /**
     * @param int $input
     * @param int $range
     * @param bool $expected
     * @dataProvider checkRangeProvider
     */
    public function testCheckRange(int $input, int $range, bool $expected) {
        $stub = $this->createStub(IntType::class);
        $stub->method("check")->willReturn(new CheckResult(true));

        $deco = new IntMaxDecorator($stub, $range);
        self::assertEquals($expected, $deco->check($input)->isSuccess());
    }

    public function checkRangeProvider() {
        return [
            [4, 5, true],
            [5, 5, true],
            [-4, -5, false],
            [10, 9, false],
        ];
    }
}
