<?php

namespace AleksandrBushuev\Schema\Tests\Builder;

use AleksandrBushuev\Schema\Builder\BoolBuilder;
use AleksandrBushuev\Schema\Type\Primitive\Bool\BoolType;
use PHPUnit\Framework\TestCase;

class BoolBuilderTest extends TestCase
{
    public function testCorrectWork() {
        $b = new BoolBuilder();
        self::assertInstanceOf(BoolType::class, $b->getType());
    }
}
