<?php


namespace Type\Object;


use Type\ISchemaType;

interface IObjectType extends ISchemaType
{
    /**
     * @return IObjectFieldType[]
     */
    public function getFields() : array;
}