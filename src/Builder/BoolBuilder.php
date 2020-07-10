<?php


namespace AleksandrBushuev\Schema\Builder;

use AleksandrBushuev\Schema\Type\ISchemaType;
use AleksandrBushuev\Schema\Type\Primitive\Bool\BoolType;

class BoolBuilder implements ISchemaTypeBuilder
{
    private BoolType $bool;

    public function __construct() {
        $this->bool = new BoolType();
    }

    public function getType(): ISchemaType {
        return $this->bool;
    }
}