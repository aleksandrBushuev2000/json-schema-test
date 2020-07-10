<?php

namespace AleksandrBushuev\Schema\Type;

use AleksandrBushuev\Schema\CheckResult;
use AleksandrBushuev\Schema\Visitor\IVisitor;

interface ISchemaType
{
    public function check($input) : CheckResult;
    public function accept(IVisitor $visitor, $input);
}