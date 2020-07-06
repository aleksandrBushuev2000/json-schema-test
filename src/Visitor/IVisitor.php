<?php


namespace Visitor;


use Type\Arr\IArrayType;
use Type\Object\IObjectFieldType;
use Type\Object\IObjectType;
use Type\Primitive\IPrimitiveType;

interface IVisitor
{
    public function visitObject(IObjectType $type, & $variable);
    public function visitField(IObjectFieldType $type, & $variable);
    public function visitArray(IArrayType $type, & $variable);
    public function visitPrimitive(IPrimitiveType $type, & $variable);
}