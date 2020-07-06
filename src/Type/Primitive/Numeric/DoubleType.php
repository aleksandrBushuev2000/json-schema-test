<?php


namespace Type\Primitive\Numeric;


use Visitor\IVisitor;

class DoubleType implements INumericType
{

    function check(&$variable) {
        return is_int($variable) || is_float($variable);
    }

    function accept(IVisitor $visitor, &$variable) {
        $visitor->visitPrimitive($this, $variable);
    }
}