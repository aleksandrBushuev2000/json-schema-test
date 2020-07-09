<?php

namespace AleksandrBuhsuev\Schema\Type\Arr;

use AleksandrBuhsuev\Schema\Type\ISchemaType;

interface IArrayType extends ISchemaType
{
    public function getChildType() : ISchemaType;
}