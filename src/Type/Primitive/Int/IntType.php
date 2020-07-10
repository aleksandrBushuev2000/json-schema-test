<?php


namespace Type\Primitive\Int;


use CheckResult;
use Error\TypeMismatchError;
use Visitor\IVisitor;


class IntType implements IIntType
{

    public function check($input): CheckResult {
        return (is_int($input))
            ? new CheckResult(true)
            : new CheckResult(false, new TypeMismatchError("double", gettype($input)));
    }

    public function accept(IVisitor $visitor, $input) {
        $visitor->visitPrimitive($this, $input);
    }
}