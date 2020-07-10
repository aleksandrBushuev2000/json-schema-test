<?php

namespace AleksandrBushuev\Schema\Tests\Type\Primitive\String;

use AleksandrBushuev\Schema\CheckResult;
use AleksandrBushuev\Schema\Type\Primitive\String\StringMinDecorator;
use AleksandrBushuev\Schema\Type\Primitive\String\StringType;
use PHPUnit\Framework\TestCase;

class StringMinDecoratorTest extends TestCase
{
    /**
     * @dataProvider correctWorkProvider
     */
    public function testCorrectWork(string $input, int $rangeCount, bool $expected) {
        $stub = $this->createStub(StringType::class);
        $stub->method("check")->willReturn(new CheckResult(true));

        $deco = new StringMinDecorator($stub, $rangeCount);

        self::assertEquals($expected, $deco->check($input)->isSuccess());
    }

    public function correctWorkProvider() {
        return [
            ["aaaaa", 5, true],
            ["yaya", 10, false],
            ["yayayaya", 250, false],
            ["rr", 0, true],
        ];
    }
}
