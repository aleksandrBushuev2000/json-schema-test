<?php


namespace Type\Primitive\Double;


use CheckResult;
use Type\Primitive\NumericRangeDecorator;
use Visitor\IVisitor;

abstract class DoubleRangeDecorator extends NumericRangeDecorator implements IDoubleType
{
    public function __construct(IDoubleType $parent, float $number) {
        parent::__construct($parent, $number);
    }

    public function check($input): CheckResult {
        $result = $this->parent->check($input);
        return $result->isSuccess()
            ? $this->checkRange($input)
            : $result;
    }

    public function accept(IVisitor $visitor, $input) {
        $visitor->visitPrimitive($this, $input);
    }
}