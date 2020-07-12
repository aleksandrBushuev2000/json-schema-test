<?php


namespace AleksandrBushuev\Schema\Visitor;

class VisitError
{
    private string $foundAt;

    public function getFoundAt() : string {
        return $this->foundAt;
    }

    private string $errorMessage;

    public function getErrorMessage() : string {
        return $this->errorMessage;
    }

    public function __construct(string $foundAt, string $errorMessage) {
        $this->errorMessage = $errorMessage;
        $this->foundAt = $foundAt;
    }
}