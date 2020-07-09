<?php


namespace AleksandrBuhsuev\Schema\Type\Arr;


use AleksandrBuhsuev\Schema\CheckResult;
use AleksandrBuhsuev\Schema\Type\ISchemaType;
use AleksandrBuhsuev\Schema\Visitor\IVisitor;

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
        $this->parent->accept($visitor, $input);
    }

    protected abstract function checkCount($input) : CheckResult;
}