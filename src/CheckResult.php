<?php

namespace AleksandrBushuev\Schema;

use AleksandrBushuev\Schema\Error\IError;

class CheckResult
{

    private bool $ok;

    public function isSuccess() : bool {
        return $this->ok;
    }

    private ?IError $error;

    public function getError() : ?IError {
        return $this->error;
    }

    public function getErrorMessage() : ?IError {
        return $this->error;
    }

    public function __construct(bool $ok, ?IError $error = null) {
        $this->ok = $ok;
        $this->error = $error;
    }
}