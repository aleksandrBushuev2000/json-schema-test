<?php


namespace AleksandrBuhsuev\Schema\Type\Arr;


use AleksandrBuhsuev\Schema\CheckResult;
use AleksandrBuhsuev\Schema\Error\CustomError;

class ArrayMaxDecorator extends ArrayRangeDecorator
{

    protected function checkCount($input): CheckResult {
        return count($input) <= $this->count
            ? new CheckResult(true)
            : new CheckResult(false, new CustomError("Too many items in array"));
    }
}