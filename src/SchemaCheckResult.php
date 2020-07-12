<?php


namespace AleksandrBushuev\Schema;

use AleksandrBushuev\Schema\Visitor\VisitError;
use ArrayObject;

class SchemaCheckResult
{
    private bool $isOk;
    private ArrayObject $errors;

    /**
     * @var mixed
    */
    private $checkedInput;

    public function __construct(bool $isOk, ArrayObject $errors, $checkedInput) {
        $this->isOk = $isOk;
        $this->errors = $errors;
        $this->checkedInput = $checkedInput;
    }

    public function getFirstError() : ?VisitError {
        return $this->errors->offsetGet(0) ?? null;
    }

    public function getErrors() : ArrayObject {
        return $this->errors;
    }

    public function isOk() : bool {
        return $this->isOk;
    }

    public function getCheckedInput() {
        return $this->checkedInput;
    }
}