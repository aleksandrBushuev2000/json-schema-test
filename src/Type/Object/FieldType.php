<?php


namespace Type\Object;


use Type\ISchemaType;
use Visitor\IVisitor;

use stdClass;

class FieldType implements IObjectFieldType
{
    private string $key;
    private ISchemaType $value;

    function getKey(): string {
        return $this->key;
    }

    function getValue(): ISchemaType {
        return $this->value;
    }

    function check(&$variable) {
        $key = $this->key;
        return $variable instanceof stdClass
            ? isset($variable->$key)
            : isset($variable[$key]);
    }

    function accept(IVisitor $visitor, &$variable) {
        return $visitor->visitField($this, $variable);
    }
}