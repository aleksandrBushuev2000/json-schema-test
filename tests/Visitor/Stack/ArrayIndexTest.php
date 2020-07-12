<?php

namespace AleksandrBushuev\Schema\Tests\Visitor\Stack;

use AleksandrBushuev\Schema\Visitor\Stack\ArrayIndex;
use PHPUnit\Framework\TestCase;

class ArrayIndexTest extends TestCase
{
    public function testToString() {
        $a = new ArrayIndex((string) 5);
        self::assertEquals("[5]", $a->toString());
    }
}
