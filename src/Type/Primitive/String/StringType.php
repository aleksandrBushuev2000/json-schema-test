<?php


namespace AleksandrBushuev\Schema\Type\Primitive\String;


use AleksandrBushuev\Schema\CheckResult;
use AleksandrBushuev\Schema\Error\TypeMismatchError;
use AleksandrBushuev\Schema\Visitor\IVisitor;

class StringType implements IStringType
{

    public function check($input): CheckResult {
        return is_string($input)
            ? new CheckResult(true)
            : new CheckResult(false, new TypeMismatchError("string", gettype($input)));
    }

    public function accept(IVisitor $visitor, &$input) {
        $visitor->visitPrimitive($this, $input);
    }
}