<?php


namespace AleksandrBushuev\Schema\Visitor\Stack;


class NestedFieldStack {

    private ?NestedFieldStackItem $head;

    public function __construct() {
        $this->head = null;
    }

    public function pushField(string $field) : void {
        $newItem = new NestedFieldStackItem($field);
        $this->push($newItem);
    }

    public function pushIndex(string $index) : void {
        $newItem = new ArrayIndex($index);
        $this->push($newItem);
    }

    public function pop() : void {
        if ($this->head != null) {
            $this->head = $this->head->next;
        }
    }

    public function getStringSnapshot() : string {
        $stringRepresentation = "";
        $cursor = $this->head;

        while ($cursor !== null) {
            $chunk = $cursor->toString();
            $stringRepresentation = $cursor === $this->head
                ? $chunk . $stringRepresentation
                : $chunk . "." . $stringRepresentation;


            $cursor = $cursor->next;
        }

        return $stringRepresentation;
    }

    private function push(NestedFieldStackItem $item) : void {
        $item->next = $this->head;
        $this->head = $item;
    }

}