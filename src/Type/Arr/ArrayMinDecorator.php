<?php


namespace AleksandrBushuev\Schema\Type\Arr;


use AleksandrBushuev\Schema\CheckResult;
use AleksandrBushuev\Schema\Error\CustomError;

class ArrayMinDecorator extends ArrayRangeDecorator
{

    protected function checkCount($input): CheckResult {
        return count($input) >= $this->count
            ? new CheckResult(true)
            : new CheckResult(false, new CustomError("Too few items in array"));
    }
}