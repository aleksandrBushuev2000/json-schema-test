<?php


namespace Type\Primitive\Numeric;


use Visitor\IVisitor;

class IntType implements INumericType
{
    public function check(&$variable) {
        return is_int($variable);
    }

    public function accept(IVisitor $visitor, &$variable) {
        $visitor->visitPrimitive($this, $variable);
    }
}