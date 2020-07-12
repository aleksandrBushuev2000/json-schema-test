<?php


namespace AleksandrBushuev\Schema\Type\Arr;


use AleksandrBushuev\Schema\CheckResult;
use AleksandrBushuev\Schema\Type\ISchemaType;
use AleksandrBushuev\Schema\Visitor\IVisitor;

abstract class ArrayRangeDecorator implements IArrayType
{
    protected IArrayType $parent;
    protected int $count;

    public function __construct(IArrayType $parent, int $count) {
        $this->parent = $parent;
        $this->count = $count;
    }

    public function getChildType(): ISchemaType {
        return $this->parent->getChildType();
    }

    public function check($input): CheckResult {
        $result = $this->parent->check($input);
        return $result->isSuccess()
            ? $this->checkCount($input)
            : $result;
    }

    public function accept(IVisitor $visitor, & $input) {
        $visitor->visitArray($this,$input);
    }

    protected abstract function checkCount($input) : CheckResult;
}