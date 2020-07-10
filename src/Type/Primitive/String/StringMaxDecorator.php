<?php


namespace AleksandrBushuev\Schema\Type\Primitive\String;


use AleksandrBushuev\Schema\CheckResult;
use AleksandrBushuev\Schema\Error\CustomError;

class StringMaxDecorator extends StringRangeDecorator
{

    protected function checkCount($input): CheckResult {
        return strlen($input) <= $this->count
            ? new CheckResult(true)
            : new CheckResult(false, new CustomError("Too long string"));
    }
}