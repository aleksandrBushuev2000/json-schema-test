<?php


namespace Type;


abstract class AbstractDecorator
{
    public ISchemaType $previous;

    public function __construct(ISchemaType $previous) {
        $this->previous = $previous;
    }
}