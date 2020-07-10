<?php


namespace Builder;


use Type\ISchemaType;
use Type\Primitive\String\IStringType;
use Type\Primitive\String\StringMaxDecorator;
use Type\Primitive\String\StringMinDecorator;
use Type\Primitive\String\StringRegexDecorator;
use Type\Primitive\String\StringType;

class StringBuilder implements ISchemaTypeBuilder
{
    private IStringType $string;

    public function __construct() {
        $this->string = new StringType();
    }

    public function max(int $max) : self {
        $this->string = new StringMaxDecorator($this->string, $max);
        return $this;
    }

    public function min(int $min) : self {
        $this->string = new StringMinDecorator($this->string, $min);
        return $this;
    }

    public function regex(string $pattern) : self {
        $this->string = new StringRegexDecorator($this->string, $pattern);
        return $this;
    }

    public function getType(): ISchemaType {
        return $this->string;
    }
}