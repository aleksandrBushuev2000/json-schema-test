<?php

namespace Error;

class TypeMismatchError implements IError
{
    const GLOBAL_MESSAGE = "Type mismatch error";

    private string $requiredType;
    private string $foundType;

    public function __construct(string $requiredType, string $foundType) {
        $this->requiredType = $requiredType;
        $this->foundType = $foundType;
    }

    public function __toString() : string {
        return self::GLOBAL_MESSAGE ." : "."required ". $this->requiredType." , found ". $this->foundType;
    }
}