<?php


namespace AleksandrBushuev\Schema\Builder;


use AleksandrBushuev\Schema\Type\Arr\ArrayMaxDecorator;
use AleksandrBushuev\Schema\Type\Arr\ArrayMinDecorator;
use AleksandrBushuev\Schema\Type\Arr\ArrayType;
use AleksandrBushuev\Schema\Type\Arr\IArrayType;
use AleksandrBushuev\Schema\Type\ISchemaType;

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