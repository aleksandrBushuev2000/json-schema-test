<?php


namespace Type\Primitive;


use Visitor\IVisitor;

abstract class AbstractPrimitive implements IPrimitiveType
{

    abstract function check(&$variable);

    function accept(IVisitor $visitor, &$variable) {
        $visitor->visitPrimitive($this, $variable);
    }
}