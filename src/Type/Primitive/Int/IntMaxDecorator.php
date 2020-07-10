<?php


namespace Type\Primitive\Int;


use CheckResult;
use Error\CustomError;

class IntMaxDecorator extends IntRangeDecorator
{

    public function checkRange($input): CheckResult {
        return $input <= $this->number
            ? new CheckResult(true)
            : new CheckResult(false, new CustomError("Input value should be >= $this->number"));
    }
}
