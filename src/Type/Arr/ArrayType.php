<?php


namespace AleksandrBuhsuev\Schema\Type\Arr;


use AleksandrBuhsuev\Schema\CheckResult;
use AleksandrBuhsuev\Schema\Error\AssocArrayError;
use AleksandrBuhsuev\Schema\Type\ISchemaType;
use AleksandrBuhsuev\Schema\Error\TypeMismatchError;
use AleksandrBuhsuev\Schema\Visitor\IVisitor;

class ArrayType implements IArrayType
{
    private ISchemaType $childType;

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
        $visitor->visitArray($this, $input);
    }
}