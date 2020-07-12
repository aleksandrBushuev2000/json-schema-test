<?php

namespace AleksandrBushuev\Schema\Tests\Type\Arr;

use AleksandrBushuev\Schema\CheckResult;
use PHPUnit\Framework\TestCase;

use AleksandrBushuev\Schema\Type\Arr\ArrayType;
use AleksandrBushuev\Schema\Type\Arr\ArrayMinDecorator;
use AleksandrBushuev\Schema\Type\ISchemaType;
use AleksandrBushuev\Schema\Visitor\IVisitor;

class ArrayMinDecoratorTest extends TestCase
{
    /**
     * @dataProvider correctWorkProvider
     * @param array $input Input array
     * @param int $min Min allowed array length
     * @param bool $result Expected result
     */
    public function testCorrectWork(array $input, int $min, bool $result) {
        $schemaType = new class implements ISchemaType {
            public function accept(IVisitor $visitor, & $input) {}
            public function check($input): CheckResult {
                return new CheckResult(true);
            }
        };

        $arr = new ArrayType($schemaType);
        $arr = new ArrayMinDecorator($arr, $min);

        self::assertEquals($result, $arr->check($input)->isSuccess());
    }

    public function correctWorkProvider() {
        return [
            [[], 5, false],
            [[1,1,1,1], 4, true],
            [[1,1,1,1,1,1,1,1], 5, true],
            [[0,0,0,0,0,0,0,0,0,0,0,0,], 20, false],
            [[1,0,1,0,1],2, true],
        ];
    }
}
