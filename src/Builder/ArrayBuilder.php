<?php


namespace Builder;


use Type\Arr\ArrayMaxDecorator;
use Type\Arr\ArrayMinDecorator;
use Type\Arr\ArrayType;
use Type\Arr\IArrayType;
use Type\ISchemaType;

class ArrayBuilder implements ISchemaTypeBuilder
{
    private IArrayType $array;

    public function __construct(ISchemaTypeBuilder $childTypeBuilder) {
        $this->array = new ArrayType($childTypeBuilder->getType());
    }

    public function max(int $count) : self {
        $this->array = new ArrayMaxDecorator($this->array, $count);
        return $this;
    }

    public function min(int $count) {
        $this->array = new ArrayMinDecorator($this->array, $count);
        return $this;
    }

    public function getType(): ISchemaType {
        return $this->array;
    }
}