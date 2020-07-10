<?php

namespace Type\Arr;

use Type\ISchemaType;

interface IArrayType extends ISchemaType
{
    public function getChildType() : ISchemaType;
}