<?php


namespace Builder;


use Type\ISchemaType;
use Type\Primitive\Int\IntMaxDecorator;
use Type\Primitive\Int\IntMinDecorator;
use Type\Primitive\Int\IntType;

class IntBuilder implements ISchemaTypeBuilder
{
    private ISchemaType $int;

    public function __construct() {
        $this->int = new IntType();
    }

    public function max(int $value) : self {
        $this->int = new IntMaxDecorator($this->int, $value);
        return $this;
    }

    public function min(int $value) : self {
        $this->int = new IntMinDecorator($this->int, $value);
        return $this;
    }

    public function getType(): ISchemaType {
        return $this->int;
    }
}