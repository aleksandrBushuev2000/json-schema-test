<?php


namespace AleksandrBushuev\Schema\Type\Arr;


use AleksandrBushuev\Schema\CheckResult;
use AleksandrBushuev\Schema\Error\AssocArrayError;
use AleksandrBushuev\Schema\Type\ISchemaType;
use AleksandrBushuev\Schema\Error\TypeMismatchError;
use AleksandrBushuev\Schema\Visitor\IVisitor;

class ArrayType implements IArrayType
{
    private ISchemaType $childType;

    public function __construct(ISchemaType $childType) {
        $this->childType = $childType;
    }

    public function getChildType(): ISchemaType {
        return $this->childType;
    }

    public function check($input): CheckResult {
        $is_array = is_array($input);
        if (!$is_array) return new CheckResult(false, new TypeMismatchError("array", gettype($input)));
        if (!($input == [] || isset($input[0]))) {
            return new CheckResult(false, new AssocArrayError());
        }

        return new CheckResult(true);
    }

    public function accept(IVisitor $visitor, & $input) : void {
        $visitor->visitArray($this,  $input);
    }
}