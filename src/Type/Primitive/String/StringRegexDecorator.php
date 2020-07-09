<?php


namespace AleksandrBuhsuev\Schema\Type\Primitive\String;


use AleksandrBuhsuev\Schema\CheckResult;
use AleksandrBuhsuev\Schema\Visitor\IVisitor;

class StringRegexDecorator implements IStringType
{

    public function check($input): CheckResult
    {
        // TODO: Implement check() method.
    }

    public function accept(IVisitor $visitor, &$input)
    {
        // TODO: Implement accept() method.
    }
}