<?php

namespace AleksandrBushuev\Schema\Tests\Type\Primitive\Int;

use AleksandrBushuev\Schema\CheckResult;
use AleksandrBushuev\Schema\Type\Primitive\Int\IntMinDecorator;
use AleksandrBushuev\Schema\Type\Primitive\Int\IntType;
use PHPUnit\Framework\TestCase;

class IntMinDecoratorTest extends TestCase
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

        $deco = new IntMinDecorator($stub, $range);
        self::assertEquals($expected, $deco->check($input)->isSuccess());
    }

    public function checkRangeProvider() {
        return [
            [4, 5, false],
            [5, 5, true],
            [-4, -5, true],
            [9, 19, false],
        ];
    }
}
