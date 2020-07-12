<?php

namespace AleksandrBushuev\Schema\Type\Primitive\Bool;

use AleksandrBushuev\Schema\Error\TypeMismatchError;
use AleksandrBushuev\Schema\Type\Primitive\IPrimitive;
use AleksandrBushuev\Schema\CheckResult;
use AleksandrBushuev\Schema\Visitor\IVisitor;

class BoolType implements IPrimitive
{

    public function check($input): CheckResult {
        return is_bool($input)
            ? new CheckResult(true)
            : new CheckResult(false, new TypeMismatchError("bool", gettype($input)));
    }

    public function accept(IVisitor $visitor, & $input) {
        $visitor->visitPrimitive($this,  $input);
    }
}