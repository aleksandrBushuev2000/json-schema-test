<?php


namespace Type;


use Visitor\IVisitor;

interface ISchemaType
{
    function check(& $variable);

    function accept(IVisitor $visitor, & $variable);
}