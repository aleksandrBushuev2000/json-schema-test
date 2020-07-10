<?php

namespace AleksandrBushuev\Schema\Tests\Type\Primitive\String;

use AleksandrBushuev\Schema\CheckResult;
use AleksandrBushuev\Schema\Type\Primitive\String\StringRegexDecorator;
use AleksandrBushuev\Schema\Type\Primitive\String\StringType;
use PHPUnit\Framework\TestCase;

class StringRegexDecoratorTest extends TestCase
{
    /**
     * @dataProvider correctWorkProvider
     */
    public function testCorrectWork(string $input, string $pattern, bool $expected) {
        $stub = $this->createStub(StringType::class);
        $stub->method("check")->willReturn(new CheckResult(true));

        $deco = new StringRegexDecorator($stub, $pattern);

        self::assertEquals($expected, $deco->check($input)->isSuccess());
    }

    public function correctWorkProvider() {
        return [
            ["DESC", "/^(DESC|ASC)$/i", true],
            ["ASC",  "/^(DESC|ASC)$/i", true],
            ["dESC", "/^(DESC|ASC)$/", false],
            ["asc",  "/^(DESC|ASC)$/", false],
            ["A", "/^B/", false],
        ];
    }
}
