<?php

namespace AleksandrBushuev\Schema\Type\ObjectField;

use AleksandrBushuev\Schema\CheckResult;
use AleksandrBushuev\Schema\Error\CustomError;
use AleksandrBushuev\Schema\Type\ISchemaType;
use AleksandrBushuev\Schema\Visitor\IVisitor;

use stdClass;

class ObjectField implements ISchemaType
{
    private string $key;

    public function getKey() : string {
        return $this->key;
    }

    private ISchemaType $value;

    public function getValue() : ISchemaType {
        return $this->value;
    }

    private bool $required = true;

    public function getRequired() {
        return $this->required;
    }

    public function setRequired(bool $required) : self {
        $this->required = $required;
        return $this;
    }

    /**
     * @var mixed
    */
    private $defaultValue = null;

    public function getDefaultValue() {
        return $this->defaultValue;
    }

    public function setDefaultValue($value) {
        $this->defaultValue = $value;
    }

    public function __construct(string $key, ISchemaType $value) {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * @var array|stdClass $input
    */
    public function check($input): CheckResult {
        return $input instanceof stdClass
            ? $this->checkInStdClass($input)
            : $this->checkInArray($input);
    }

    public function checkInArray(array $input) {
        return isset($input[$this->key])
            ? new CheckResult(true)
            : new CheckResult(false, new CustomError("Missing Field: ".$this->key));
    }

    private function checkInStdClass(stdClass $input) : CheckResult {
        $key = $this->key;

        return isset($input->$key)
            ? new CheckResult(true)
            : new CheckResult(false, new CustomError("Missing Field: ".$key));
    }

    public function accept(IVisitor $visitor, & $input) {
        $visitor->visitField($this, $input);
    }
}