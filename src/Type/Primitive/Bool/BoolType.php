<?php

namespace AleksandrBuhsuev\Schema\Type\Primitive\Bool;

use AleksandrBuhsuev\Schema\Error\TypeMismatchError;
use AleksandrBuhsuev\Schema\Type\Primitive\IPrimitive;
use AleksandrBuhsuev\Schema\CheckResult;
use AleksandrBuhsuev\Schema\Visitor\IVisitor;

class BoolType implements IPrimitive
{

    public function check($input): CheckResult {
        return is_bool($input)
            ? new CheckResult(true)
            : new CheckResult(false, new TypeMismatchError("bool", gettype($input)));
    }

    public function accept(IVisitor $visitor, &$input) {
        $visitor->visitPrimitive($this, $input);
    }
}