<?php


namespace AleksandrBushuev\Schema\Type\Primitive\String;


use AleksandrBushuev\Schema\CheckResult;
use AleksandrBushuev\Schema\Visitor\IVisitor;

abstract class StringRangeDecorator implements IStringType
{
    protected IStringType $parent;
    protected int $count;

    public function __construct(IStringType $parent, int $count) {
        $this->parent = $parent;
        $this->count = $count;
    }

    public function check($input): CheckResult {
        $result = $this->parent->check($input);
        return $result->isSuccess()
            ? $this->checkCount($input)
            : $result;
    }

    public function accept(IVisitor $visitor, $input) {
        $visitor->visitPrimitive($this, $input);
    }

    protected abstract function checkCount($input) : CheckResult;
}