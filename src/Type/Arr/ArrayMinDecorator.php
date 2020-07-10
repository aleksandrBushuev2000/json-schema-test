<?php


namespace Type\Arr;


use CheckResult;
use Error\CustomError;

class ArrayMinDecorator extends ArrayRangeDecorator
{

    protected function checkCount($input): CheckResult {
        return count($input) >= $this->count
            ? new CheckResult(true)
            : new CheckResult(false, new CustomError("Too few items in array"));
    }
}