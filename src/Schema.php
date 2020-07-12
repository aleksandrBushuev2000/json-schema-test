<?php

namespace AleksandrBushuev\Schema;

use AleksandrBushuev\Schema\Builder\ISchemaTypeBuilder;
use AleksandrBushuev\Schema\Type\ISchemaType;
use AleksandrBushuev\Schema\Visitor\Visitor;


class Schema
{
    public ISchemaType $root;

    public static function create(ISchemaTypeBuilder $builder) {
        return new Schema($builder->getType());
    }

    public function __construct(ISchemaType $type) {
        $this->root = $type;
    }

    public function checkJsonInput($input, Options $options) {
        $inputVisitor = new Visitor($input, $options, $this->root);
        $inputVisitor->run();
        $success = $inputVisitor->isSuccess();
        return new SchemaCheckResult(
            $success,
            $inputVisitor->getErrors(),
            $success === true
                ? $inputVisitor->getInput()
                : $input
        );
    }
}