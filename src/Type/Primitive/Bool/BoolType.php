<?php

namespace Type\Primitive\Bool;

use Error\TypeMismatchError;
use Type\Primitive\IPrimitive;
use CheckResult;
use Visitor\IVisitor;

class BoolType implements IPrimitive
{

    public function check($input): CheckResult {
        return is_bool($input)
            ? new CheckResult(true)
            : new CheckResult(false, new TypeMismatchError("bool", gettype($input)));
    }

    public function accept(IVisitor $visitor, $input) {
        $visitor->visitPrimitive($this, $input);
    }
}