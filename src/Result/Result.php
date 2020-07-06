<?php


namespace Result;


class Result
{
    private bool $success;

    public function getSuccess() : bool {
        return $this->success;
    }

    private string $errorMessage;

    public function getErrorMessage() : string {
        return $this->errorMessage;
    }

    public function __construct(bool $success, string $errorMessage) {
        $this->success = $success;
        $this->errorMessage = $errorMessage;
    }
}