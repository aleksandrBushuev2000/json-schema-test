<?php


namespace AleksandrBuhsuev\Schema\Object;


use AleksandrBuhsuev\Schema\CheckResult;
use AleksandrBuhsuev\Schema\Error\TypeMismatchError;
use AleksandrBuhsuev\Schema\Type\ObjectField\ObjectField;
use AleksandrBuhsuev\Schema\Visitor\IVisitor;

use AleksandrBuhsuev\Schema\Type\ISchemaType;

use stdClass;

class SchemaObject implements ISchemaType
{

    /**
     * @var array<ObjectField>
    */
    private $fields = [];

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

    public function accept(IVisitor $visitor, & $input) {
        $visitor->visitObject($this, $input);
    }
}