<?php


namespace AleksandrBuhsuev\Schema\Type\Primitive\String;


use AleksandrBuhsuev\Schema\CheckResult;
use AleksandrBuhsuev\Schema\Error\TypeMismatchError;
use AleksandrBuhsuev\Schema\Visitor\IVisitor;

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