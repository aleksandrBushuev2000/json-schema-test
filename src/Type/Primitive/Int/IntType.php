<?php


namespace AleksandrBushuev\Schema\Type\Primitive\Int;


use AleksandrBushuev\Schema\CheckResult;
use AleksandrBushuev\Schema\Error\TypeMismatchError;
use AleksandrBushuev\Schema\Visitor\IVisitor;


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