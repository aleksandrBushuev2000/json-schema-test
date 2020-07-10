<?php

namespace AleksandrBushuev\Schema\Tests\Type\Arr;

use AleksandrBushuev\Schema\CheckResult;
use PHPUnit\Framework\TestCase;

use AleksandrBushuev\Schema\Type\Arr\ArrayType;
use AleksandrBushuev\Schema\Type\Arr\ArrayMaxDecorator;
use AleksandrBushuev\Schema\Type\ISchemaType;
use AleksandrBushuev\Schema\Visitor\IVisitor;

class ArrayMaxDecoratorTest extends TestCase
{
      /**
       * @dataProvider correctWorkProvider
       * @param array $input Input array
       * @param int $max Max allowed array length
       * @param bool $result Expected result
      */
      public function testCorrectWork(array $input, int $max, bool $result) {
        $schemaType = new class implements ISchemaType {
            public function accept(IVisitor $visitor, $input) {}
            public function check($input): CheckResult {
                return new CheckResult(true);
            }
        };

        $arr = new ArrayType($schemaType);
        $arr = new ArrayMaxDecorator($arr, $max);

        self::assertEquals($result, $arr->check($input)->isSuccess());
    }

    public function correctWorkProvider() {
        return [
            [[], 5, true],
            [[1,1,1,1], 4, true],
            [[1,1,1,1,1,1,1,1], 5, false],
            [[0,0,0,0,0,0,0,0,0,0,0,0,], 20, true],
            [[1,0,1,0,1],2, false],
        ];
    }
}
