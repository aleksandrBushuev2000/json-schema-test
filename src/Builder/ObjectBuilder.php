<?php


namespace AleksandrBushuev\Schema\Builder;


use AleksandrBushuev\Schema\Object\SchemaObject;
use AleksandrBushuev\Schema\Type\ISchemaType;

class ObjectBuilder implements ISchemaTypeBuilder
{
    private SchemaObject $obj;

    /**
     * @var FieldBuilder[] $fields
    */
    public function __construct(array $fields) {
        for ($i = 0; $i < count($fields); $i++) {
            $fields[$i] = $fields[$i]->getType();
        }

        $this->obj = new SchemaObject($fields);
    }

    public function getType(): ISchemaType {
        return $this->obj;
    }
}