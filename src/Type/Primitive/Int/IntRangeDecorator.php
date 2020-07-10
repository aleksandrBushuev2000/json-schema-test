<?php


namespace AleksandrBushuev\Schema\Type\Primitive\Int;


use AleksandrBushuev\Schema\CheckResult;

use AleksandrBushuev\Schema\Type\Primitive\NumericRangeDecorator;
use AleksandrBushuev\Schema\Visitor\IVisitor;

abstract class IntRangeDecorator extends NumericRangeDecorator implements IIntType
{

    abstract function checkRange($input): CheckResult;

    public function __construct(IIntType $parent, int $number) {
        parent::__construct($parent, $number);
    }

    public function check($input): CheckResult {
        $result = $this->parent->check($input);

        return $result->isSuccess()
            ? $this->checkRange($input)
            : $result;
    }

    public function accept(IVisitor $visitor, &$input) {
        $visitor->visitPrimitive($this, $input);
    }
}