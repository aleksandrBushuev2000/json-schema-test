<?php


namespace AleksandrBuhsuev\Schema\Error;


class CustomError implements IError
{
    private string $message;

    public function __construct(string $message) {
        $this->message = $message;
    }

    public function __toString() : string {
        return $this->message;
    }
}