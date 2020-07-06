<?php


namespace Type\Object;


use Visitor\IVisitor;

use stdClass;

class ObjectType implements IObjectType
{
    /**
     * @var IObjectFieldType[] $fields
    */
    private array $fields;

    /**
     * @return IObjectFieldType[]
    */
    public function getFields() : array {
        return $this->fields;
    }

    public function __construct(array $fields) {
        $this->fields = $fields;
    }

    public function check(& $variable) {
        return is_array($variable) || ($variable instanceof stdClass);
    }

    function accept(IVisitor $visitor, & $variable) {
        $visitor->visitObject($this, $variable);
    }
}