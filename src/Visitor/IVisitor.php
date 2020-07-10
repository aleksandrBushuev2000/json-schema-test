<?php

namespace AleksandrBushuev\Schema\Visitor;

use AleksandrBushuev\Schema\Type\Object\SchemaObject;
use AleksandrBushuev\Schema\Type\Arr\IArrayType;
use AleksandrBushuev\Schema\Type\ObjectField\ObjectField;
use AleksandrBushuev\Schema\Type\Primitive\IPrimitive;

interface IVisitor
{
    public function visitArray(IArrayType $array, $input) : void;
    public function visitField(ObjectField $field, $input) : void;
    public function visitObject(SchemaObject $object, $input) : void;
    public function visitPrimitive(IPrimitive $primitive, $input) : void;
}