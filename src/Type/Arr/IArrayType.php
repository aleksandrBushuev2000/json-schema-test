<?php

namespace AleksandrBushuev\Schema\Type\Arr;

use AleksandrBushuev\Schema\Type\ISchemaType;

interface IArrayType extends ISchemaType
{
    public function getChildType() : ISchemaType;
}