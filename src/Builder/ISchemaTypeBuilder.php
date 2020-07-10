<?php


namespace AleksandrBushuev\Schema\Builder;

use AleksandrBushuev\Schema\Type\ISchemaType;

interface ISchemaTypeBuilder
{
    public function getType() : ISchemaType;
}