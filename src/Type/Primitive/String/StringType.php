<?php


namespace Type\Primitive\String;


use CheckResult;
use Error\TypeMismatchError;
use Visitor\IVisitor;

class StringType implements IStringType
{

    public function check($input): CheckResult {
        return is_string($input)
            ? new CheckResult(true)
            : new CheckResult(false, new TypeMismatchError("string", gettype($input)));
    }

    public function accept(IVisitor $visitor, $input) {
        $visitor->visitPrimitive($this, $input);
    }
}