<?php


namespace AleksandrBushuev\Schema\Type\Primitive\Double;

use AleksandrBushuev\Schema\Error\CustomError;
use AleksandrBushuev\Schema\CheckResult;

class DoubleMaxDecorator extends DoubleRangeDecorator
{

    public function checkRange($input): CheckResult {
        return $input <= $this->number
            ? new CheckResult(true)
            : new CheckResult(false, new CustomError("Input value should be <= $this->number"));
    }
}