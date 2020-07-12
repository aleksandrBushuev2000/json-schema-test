<?php


namespace AleksandrBushuev\Schema\Visitor;

use AleksandrBushuev\Schema\CheckResult;
use AleksandrBushuev\Schema\Error\CustomError;
use AleksandrBushuev\Schema\Options;
use AleksandrBushuev\Schema\Type\Arr\IArrayType;
use AleksandrBushuev\Schema\Type\ISchemaType;
use AleksandrBushuev\Schema\Type\Object\SchemaObject;
use AleksandrBushuev\Schema\Type\ObjectField\ObjectField;
use AleksandrBushuev\Schema\Type\Primitive\IPrimitive;
use AleksandrBushuev\Schema\Visitor\Stack\NestedFieldStack;

use ArrayObject;
use stdClass;


class Visitor implements IVisitor
{
    /**
     * @var mixed $input
    */
    private $input;

    private Options $options;
    private ISchemaType $root;

    public function getInput() {
        return $this->input;
    }

    private NestedFieldStack $fields;

    /**
     * @var ArrayObject<VisitError>
    */
    private ArrayObject $errors;

    public function getErrors() : ArrayObject {
        return $this->errors;
    }

    public function getFirstError() : ?VisitError {
        return $this->errors->offsetGet(0) ?? null;
    }

    private bool $isErrorWasFound = false;

    public function isSuccess() : bool {
        return (!$this->isErrorWasFound);
    }

    public function __construct($input, Options $options, ISchemaType $root) {
        $this->input = $input;
        $this->root = $root;
        $this->options = $options;
        $this->fields = new NestedFieldStack();
        $this->errors = new ArrayObject([]);
    }

    public function run() {
        $this->root->accept($this, $this->input);
    }

    public function visitArray(IArrayType $array, & $input): void {
        $checkResult = $array->check($input);

        if ($checkResult->isSuccess() === false) {
            $this->handleError($checkResult);
        } else {
            $childType = $array->getChildType();

            foreach ($input as $index => $value) {
                if ($this->needCheck() === true) {
                    $this->fields->pushIndex((string) $index);
                    $childType->accept($this, $value);
                    $this->fields->pop();
                }
            }
        }
    }

    public function visitField(ObjectField $field, & $input): void {
        $this->fields->pushField($field->getKey());
        $checkResult = $field->check($input);

        if ($checkResult->isSuccess() === true) {
            $fieldValueNode = $field->getValue();
            $value = $this->getFieldValue($input, $field->getKey());
            $fieldValueNode->accept($this, $value);
        } else {
            if (!$this->tryToSetDefaultValue($input, $field)) {
                $this->handleError($checkResult);
            }
        }

        $this->fields->pop();
    }

    public function visitObject(SchemaObject $object, & $input): void {
        $checkResult = $object->check($input);

        if ($checkResult->isSuccess() === false) {
            $this->handleError($checkResult);
        } else {
            $fields = $object->getFields();

            /**
             * @var ObjectField $field
             */
            foreach ($fields as $key => $field) {
                if ($this->needCheck() === true) {
                    $field->accept($this, $input);
                }
            }

            if ($this->needCheck() && $this->options->allowAdditionalFields === false) {
                $hasNotExtraFields = $this->checkFieldsCount($input, $object);
                if ($hasNotExtraFields === false) {
                    $this->handleError(new CheckResult(
                        false,
                        new CustomError("User input has extra fields")
                    ));
                }
            }
        }
    }

    public function visitPrimitive(IPrimitive $primitive, & $input): void {
        $checkResult = $primitive->check($input);
        if ($checkResult->isSuccess() === false) {
            $this->handleError($checkResult);
        }
    }

    private function handleError(CheckResult $errorFeedback) {
        $this->errors->append(
            new VisitError($this->fields->getStringSnapshot(), $errorFeedback->getErrorMessage())
        );
        $this->isErrorWasFound = true;
    }

    private function getFieldValue($input, $key) {
        return $input instanceof stdClass
            ? $input->$key
            : $input[$key];
    }

    private function needCheck() : bool {
        return $this->isErrorWasFound === false
            || $this->options->checkUntilFirstError === false;
    }

    private function tryToSetDefaultValue(& $input, ObjectField $field) : bool {
        if ($field->getRequired() === false) {
            $key = $field->getKey();
            $value = $field->getDefaultValue();
            if ($value !== null
                || $this->options->allowSetDefaultValueIfNull === true) {
                $this->setFieldKey($input, $key, $value);
                return true;
            }
        }

        return false;
    }

    private function setFieldKey(& $input, string $key, $value) {
        $input instanceof stdClass
            ? $input->$key = $value
            : $input[$key] = $value;
    }

    /**
     * @param array|stdClass $input
     * @param SchemaObject $object
     * @return bool
     */
    private function checkFieldsCount($input, SchemaObject $object) : bool {
        $count =  count($object->getFields());
        if (is_array($input)) {
            return  $count === count($input);
        } else {
            return $count === count(get_object_vars($input));
        }
    }
}