<?php


namespace Type\Object;


use CheckResult;
use Error\TypeMismatchError;
use Type\ObjectField\ObjectField;
use Visitor\IVisitor;

use Type\ISchemaType;

use stdClass;

class SchemaObject implements ISchemaType
{

    /**
     * @var ObjectField[]
    */
    private array $fields;

    /**
     * @return array<ObjectField>
    */
    public function getFields() {
        return $this->fields;
    }

    /**
     * @param array<ObjectField> $fields
    */
    public function __construct(array $fields) {
        $this->fields = $fields;
    }

    public function check($input): CheckResult {
        if (is_array($input) || ($input instanceof stdClass)) {
            return new CheckResult(true);
        } else {
            return new CheckResult(false,
                new TypeMismatchError("stdClass|array(assoc)", gettype($input)
                )
            );
        }
    }

    public function accept(IVisitor $visitor, $input) {
        $visitor->visitObject($this, $input);
    }
}