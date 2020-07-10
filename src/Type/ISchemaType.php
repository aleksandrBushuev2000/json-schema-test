<?php

namespace Type;

use CheckResult;
use Visitor\IVisitor;

interface ISchemaType
{
    public function check($input) : CheckResult;
    public function accept(IVisitor $visitor, $input);
}