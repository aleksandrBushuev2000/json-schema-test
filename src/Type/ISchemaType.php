<?php

namespace AleksandrBuhsuev\Schema\Type;

use AleksandrBuhsuev\Schema\CheckResult;
use AleksandrBuhsuev\Schema\Visitor\IVisitor;

interface ISchemaType
{
    public function check($input) : CheckResult;
    public function accept(IVisitor $visitor, & $input);
}