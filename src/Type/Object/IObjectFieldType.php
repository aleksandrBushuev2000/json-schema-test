<?php


namespace Type\Object;

use Type\ISchemaType;

interface IObjectFieldType extends ISchemaType
{
    function getKey() : string;
    function getValue() : ISchemaType;
}