<?php


namespace Type\Primitive\String;


use Type\Primitive\IPrimitiveType;

use Visitor\IVisitor;

class StringType implements IPrimitiveType
{

    function check(&$variable) {
        return is_string($variable);
    }

    function accept(IVisitor $visitor, &$variable) {
        $visitor->visitPrimitive($this, $variable);
    }
}