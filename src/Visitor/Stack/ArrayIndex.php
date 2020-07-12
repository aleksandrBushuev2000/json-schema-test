<?php


namespace AleksandrBushuev\Schema\Visitor\Stack;


class ArrayIndex extends NestedFieldStackItem {
    public function toString(): string {
        return "[".$this->field."]";
    }
}