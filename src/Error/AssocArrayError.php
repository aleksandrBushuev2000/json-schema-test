<?php


namespace AleksandrBushuev\Schema\Error;


class AssocArrayError implements IError
{

    public function __toString() : string {
        return "Default array required, assoc given";
    }
}