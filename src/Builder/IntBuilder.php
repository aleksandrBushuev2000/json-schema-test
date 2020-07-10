<?php


namespace AleksandrBushuev\Schema\Builder;


use AleksandrBushuev\Schema\Type\ISchemaType;
use AleksandrBushuev\Schema\Type\Primitive\Int\IIntType;
use AleksandrBushuev\Schema\Type\Primitive\Int\IntMaxDecorator;
use AleksandrBushuev\Schema\Type\Primitive\Int\IntMinDecorator;
use AleksandrBushuev\Schema\Type\Primitive\Int\IntType;

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

    public function getType(): IIntType {
        return $this->int;
    }
}