<?php


namespace AleksandrBushuev\Schema\Type\Primitive\String;


use AleksandrBushuev\Schema\CheckResult;

class StringMaxDecorator extends StringRangeDecorator
{

    protected function checkCount($input): CheckResult {
        return strlen($input) <= $this->count;
    }
}