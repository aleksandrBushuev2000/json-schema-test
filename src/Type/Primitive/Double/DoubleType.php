<?php


namespace Type\Primitive\Double;


use CheckResult;
use Error\TypeMismatchError;
use Visitor\IVisitor;


class DoubleType implements IDoubleType
{

    public function check($input): CheckResult {
        return (is_int($input) || is_double($input))
            ? new CheckResult(true)
            : new CheckResult(false, new TypeMismatchError("double", gettype($input)));
    }

    public function accept(IVisitor $visitor, $input) {
        $visitor->visitPrimitive($this, $input);
    }
}