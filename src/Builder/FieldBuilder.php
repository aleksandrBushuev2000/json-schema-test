<?php


namespace AleksandrBushuev\Schema\Builder;


use AleksandrBushuev\Schema\Type\ObjectField\ObjectField;

class FieldBuilder implements ISchemaTypeBuilder
{
    private ObjectField $field;

    public function __construct(string $key, ISchemaTypeBuilder $value) {
        $this->field = new ObjectField($key, $value->getType());
    }

    public function required(bool $required = true) : self {
        $this->field->setRequired($required);
        return $this;
    }

    public function defaultValue($value) : self {
        $this->field->setDefaultValue($value);
        return $this;
    }

    public function getType(): ObjectField {
        return $this->field;
    }
}