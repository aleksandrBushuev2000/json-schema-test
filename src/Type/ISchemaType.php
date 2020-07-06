<?php


namespace Type;


interface ISchemaType
{
    function check(& $variable);
}