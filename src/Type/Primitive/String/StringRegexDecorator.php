<?php


namespace AleksandrBushuev\Schema\Type\Primitive\String;


use AleksandrBushuev\Schema\CheckResult;
use AleksandrBushuev\Schema\Error\CustomError;
use AleksandrBushuev\Schema\Visitor\IVisitor;

class StringRegexDecorator implements IStringType
{
    private IStringType $parent;
    private string $pattern;

    public function __construct(IStringType $parent, string $pattern) {
        $this->parent = $parent;
        $this->pattern = $pattern;
    }

    public function check($input): CheckResult {
        $result = $this->parent->check($input);
        if ($result->isSuccess()) {
            $checkInfo = preg_match($this->pattern, $input);
            if ($checkInfo === 0 || $checkInfo === false) {
                return new CheckResult(false, new CustomError("String doesn't match expected pattern"));
            } else {
                return new CheckResult(true);
            }
        } else {
            return $result;
        }
    }

    public function accept(IVisitor $visitor, $input) {
        $visitor->visitPrimitive($this, $input);
    }
}