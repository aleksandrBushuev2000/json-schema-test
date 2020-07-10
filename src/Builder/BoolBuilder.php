<?php


namespace Builder;

use Type\ISchemaType;
use Type\Primitive\Bool\BoolType;

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