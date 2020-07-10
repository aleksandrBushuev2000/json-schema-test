<?php

namespace AleksandrBushuev\Schema;

use AleksandrBushuev\Schema\Builder\ArrayBuilder;
use AleksandrBushuev\Schema\Builder\BoolBuilder;
use AleksandrBushuev\Schema\Builder\DoubleBuilder;
use AleksandrBushuev\Schema\Builder\FieldBuilder;
use AleksandrBushuev\Schema\Builder\IntBuilder;
use AleksandrBushuev\Schema\Builder\ISchemaTypeBuilder;
use AleksandrBushuev\Schema\Builder\ObjectBuilder;
use AleksandrBushuev\Schema\Builder\StringBuilder;

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