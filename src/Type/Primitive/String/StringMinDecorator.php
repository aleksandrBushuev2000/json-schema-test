<?php


namespace AleksandrBushuev\Schema\Type\Primitive\String;


use AleksandrBushuev\Schema\CheckResult;

class StringMinDecorator extends StringRangeDecorator
{

    protected function checkCount($input): CheckResult {
        return strlen($input) >= $this->count;
    }
}