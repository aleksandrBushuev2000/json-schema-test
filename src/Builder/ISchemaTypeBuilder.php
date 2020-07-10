<?php


namespace Builder;

use Type\ISchemaType;

interface ISchemaTypeBuilder
{
    public function getType() : ISchemaType;
}