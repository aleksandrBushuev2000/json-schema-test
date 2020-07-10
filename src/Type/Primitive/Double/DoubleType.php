<?php


namespace AleksandrBushuev\Schema\Type\Primitive\Double;


use AleksandrBushuev\Schema\CheckResult;
use AleksandrBushuev\Schema\Error\TypeMismatchError;
use AleksandrBushuev\Schema\Visitor\IVisitor;


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