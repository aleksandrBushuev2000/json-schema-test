<?php


namespace AleksandrBushuev\Schema\Visitor\Stack;


class NestedFieldStackItem {
    public ?NestedFieldStackItem $next;
    public string $field;

    public function __construct(string $field) {
        $this->field = $field;
        $this->next = null;
    }

    public function toString() : string {
        return $this->field;
    }
}