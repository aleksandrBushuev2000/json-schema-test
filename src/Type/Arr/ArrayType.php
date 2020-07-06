<?php


namespace Type\Arr;


use Type\ISchemaType;
use Visitor\IVisitor;

class ArrayType implements IArrayType
{
    private ISchemaType $itemType;

    public function getItemType(): ISchemaType {
        return $this->itemType;
    }

    public function __construct(ISchemaType $itemType) {
        $this->itemType = $itemType;
    }

    function check(& $variable) {
        return is_array($variable) && (count($variable) == 0 || isset($variable[0]));
    }

    function accept(IVisitor $visitor, &$variable) {
        $visitor->visitArray($this, $variable);
    }
}