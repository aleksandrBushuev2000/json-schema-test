<?php


namespace Builder;


use Type\ISchemaType;
use Type\Primitive\Double\DoubleMaxDecorator;
use Type\Primitive\Double\DoubleMinDecorator;
use Type\Primitive\Double\DoubleType;

class DoubleBuilder implements ISchemaTypeBuilder
{
    private ISchemaType $double;

    public function __construct() {
        $this->double = new DoubleType();
    }

    public function max(float $value) : self {
        $this->double = new DoubleMaxDecorator($this->double, $value);
        return $this;
    }

    public function min(float $value) : self {
        $this->double = new DoubleMinDecorator($this->double, $value);
        return $this;
    }

    public function getType(): ISchemaType {
        return $this->double;
    }
}