<?php


namespace Type\Primitive\String;


use CheckResult;
use Error\CustomError;

class StringMinDecorator extends StringRangeDecorator
{

    protected function checkCount($input): CheckResult {
        return strlen($input) >= $this->count
            ? new CheckResult(true)
            : new CheckResult(false, new CustomError("Too short string"));
    }
}