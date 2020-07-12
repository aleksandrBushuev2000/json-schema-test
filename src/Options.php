<?php


namespace AleksandrBushuev\Schema;


class Options
{
    public bool $allowSetDefaultValue = true;
    public bool $allowSetDefaultValueIfNull = false;
    public bool $allowAdditionalFields = true;
    public bool $checkUntilFirstError = true;

    public static function create() : Options {
        return new Options();
    }

    public function allowSetDefaultValue(bool $var) : self {
        $this->allowSetDefaultValue = $var;
        return $this;
    }

    public function allowSetDefaultValueIfNull(bool $var) : self {
        $this->allowSetDefaultValueIfNull = $var;
        return $this;
    }

    public function allowAdditionalFields(bool $var) : self {
        $this->allowAdditionalFields = $var;
        return $this;
    }

    public function checkUntilFirstError(bool $var) : self {
        $this->checkUntilFirstError = $var;
        return $this;
    }
}