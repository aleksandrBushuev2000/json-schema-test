<?php

namespace Type\Primitive;

use CheckResult;

abstract class NumericRangeDecorator {

    protected IPrimitive $parent;

    protected float $number;

    public function __construct(IPrimitive $parent, float $number) {
        $this->parent = $parent;
        $this->number = $number;
    }

    public abstract function checkRange($input) : CheckResult;
}