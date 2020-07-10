<?php

namespace Visitor;

use Type\Object\SchemaObject;
use Type\Arr\IArrayType;
use Type\ObjectField\ObjectField;
use Type\Primitive\IPrimitive;

interface IVisitor
{
    public function visitArray(IArrayType $array, $input) : void;
    public function visitField(ObjectField $field, $input) : void;
    public function visitObject(SchemaObject $object, $input) : void;
    public function visitPrimitive(IPrimitive $primitive, $input) : void;
}