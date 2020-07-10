<?php

use Builder\ISchemaTypeBuilder;
use Type\ISchemaType;

class Schema
{
    public ISchemaType $root;

    public function create(ISchemaTypeBuilder $builder) {
        return new Schema($builder->getType());
    }

    public function __construct(ISchemaType $type) {
        $this->root = $type;
    }
}