<?php


namespace AleksandrBushuev\Schema\Type\Primitive\Int;


use AleksandrBushuev\Schema\CheckResult;
use AleksandrBushuev\Schema\Error\CustomError;

class IntMaxDecorator extends IntRangeDecorator
{

    public function checkRange($input): CheckResult {
        return $input <= $this->number
            ? new CheckResult(true)
            : new CheckResult(false, new CustomError("Input value should be >= $this->number"));
    }
}
