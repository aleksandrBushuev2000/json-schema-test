<?php

namespace AleksandrBushuev\Schema\Tests\Visitor\Stack;

use AleksandrBushuev\Schema\Visitor\Stack\NestedFieldStack;
use PHPUnit\Framework\TestCase;

class NestedFieldStackTest extends TestCase
{

    public function testPushField() : NestedFieldStack {
        $s = new NestedFieldStack();
        $s->pushField("f_");
        $s->pushField("f__");
        $s->pushField("f___");

        self::assertEquals("f_.f__.f___", $s->getStringSnapshot());

        return $s;
    }

    /**
     * @depends testPushField
    */
    public function testPushIndex(NestedFieldStack $stack) {
        $stack->pushIndex((string) 5);

        self::assertEquals("f_.f__.f___.[5]", $stack->getStringSnapshot());

        return $stack;
    }

    /**
     * @depends testPushIndex
    */
    public function testPop(NestedFieldStack $stack) {
        $stack->pop();
        self::assertEquals("f_.f__.f___", $stack->getStringSnapshot());
    }

    public function testPopEmpty() {
        $stack = new NestedFieldStack();

        self::assertNull($stack->pop());
    }
}
