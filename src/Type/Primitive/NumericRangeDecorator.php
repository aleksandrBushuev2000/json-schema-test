<?php

namespace AleksandrBushuev\Schema\Type\Primitive;

use AleksandrBushuev\Schema\CheckResult;

abstract class NumericRangeDecorator {

    protected IPrimitive $parent;

    protected float $number;

    public function __construct(IPrimitive $parent, float $number) {
        $this->parent = $parent;
        $this->number = $number;
    }

    public abstract function checkRange($input) : CheckResult;
}