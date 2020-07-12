<?php

namespace AleksandrBushuev\Schema\Tests\Visitor\Stack;

use AleksandrBushuev\Schema\Visitor\Stack\NestedFieldStackItem;
use PHPUnit\Framework\TestCase;

class NestedFieldStackItemTest extends TestCase
{

    public function testToString() {
        $i = new NestedFieldStackItem("field");
        self::assertEquals("field",$i->toString());
    }
}
