<?php


namespace Type\Primitive\Bool;


use Visitor\IVisitor;

class BoolType implements IBoolType
{

    function check(&$variable) {
        return $variable === true || $variable === false;
    }

    function accept(IVisitor $visitor, & $variable) {
        $visitor->visitPrimitive($visitor, $variable);
    }
}