<?php


namespace Type\Primitive\Double;


use CheckResult;
use Error\CustomError;

class DoubleMinDecorator extends DoubleRangeDecorator
{

    public function checkRange($input): CheckResult {
        return $input >= $this->number
            ? new CheckResult(true)
            : new CheckResult(false, new CustomError("Input value should be >= $this->number"));
    }
}