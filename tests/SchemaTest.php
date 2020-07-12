<?php

namespace AleksandrBushuev\Schema\Tests;

use AleksandrBushuev\Schema\Factory;
use AleksandrBushuev\Schema\Options;
use AleksandrBushuev\Schema\Schema;
use PHPUnit\Framework\TestCase;

use ArrayObject;
use stdClass;

class SchemaTest extends TestCase
{
    private ArrayObject $schemas;

    public function setUp(): void {
        parent::setUp();
        $this->schemas = new ArrayObject();

        $f = new Factory();

        $this->schemas->append(
           Schema::create(
               $f->object([
                   $f->field("sort", $f->object([
                       $f->field("date", $f->string()->regex("/^(DESC|ASC)$/"))
                           ->required(false)
                           ->defaultValue("DESC"),
                       $f->field("price", $f->string()->regex("/^(DESC|ASC)$/"))
                           ->required(false)
                           ->defaultValue("DESC")
                   ]))->required(false)->defaultValue([
                       "date" => "ASC",
                       "price" => "ASC"
                   ]),
                   $f->field("arr", $f->array(
                       $f->array(
                           $f->object([
                               $f->field("key", $f->string()),
                               $f->field("key_2", $f->array($f->int()))
                           ])
                       )
                   ))->required(false)->defaultValue([])
               ])
           )
        );
    }

    /**
     * @dataProvider jsonInputProvider
     * @param array|stdClass $input Input to check
     * @param bool $result Expected result
     * @param array|stdClass $checkedInput
     */
    public function testCheckJsonInput($input, $result, $checkedInput) {
        /**
         * @var Schema $schema
        */
        $schema = $this->schemas->offsetGet(0);

        $resultOfChecking = $schema->checkJsonInput($input, Options::create());

        self::assertEquals($result, $resultOfChecking->isOk());
        self::assertEquals($checkedInput, $resultOfChecking->getCheckedInput());
    }

    public function jsonInputProvider() {
        return [
            [
                [
                    "sort" => [
                        "date" => "ASC",
                        "price" => "DESC"
                    ]
                ],
                true,
                [
                    "sort" => [
                        "date" => "ASC",
                        "price" => "DESC"
                    ],
                    "arr" => []
                ]
            ],
            [
                [
                    "sort" => "string"
                ],
                false,
                [
                    "sort" => "string"
                ]

            ],
            [
                [
                    "arr" => "string"
                ],
                false,
                [
                    "arr" => "string"
                ]
            ],
        ];
    }


}
