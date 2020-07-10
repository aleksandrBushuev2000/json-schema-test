<?php

use Builder\ArrayBuilder;
use Builder\BoolBuilder;
use Builder\DoubleBuilder;
use Builder\FieldBuilder;
use Builder\IntBuilder;
use Builder\ISchemaTypeBuilder;
use Builder\ObjectBuilder;
use Builder\StringBuilder;

class Factory
{
    public function int() : IntBuilder {
        return new IntBuilder();
    }

    public function bool() : BoolBuilder {
        return new BoolBuilder();
    }

    public function double() : DoubleBuilder {
        return new DoubleBuilder();
    }

    public function string() : StringBuilder {
        return new StringBuilder();
    }

    public function array(ISchemaTypeBuilder $child) : ArrayBuilder{
        return new ArrayBuilder($child);
    }

    public function field(string $key, ISchemaTypeBuilder $value) : FieldBuilder {
        return new FieldBuilder($key, $value);
    }

    /**
     * @var FieldBuilder[] $fields
     * @return ObjectBuilder
    */
    public function object(array $fields) : ObjectBuilder {
        return new ObjectBuilder($fields);
    }
}