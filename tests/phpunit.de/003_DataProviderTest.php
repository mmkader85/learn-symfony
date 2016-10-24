<?php

namespace PhpunitDe\Tests;

use PHPUnit\Framework\TestCase;

class DataProviderTest extends TestCase
{
    /**
     * @param $num1
     * @param $num2
     * @param $sum
     * @dataProvider sumProvider
     */
    public function testSum($num1, $num2, $sum)
    {
        static::assertEquals($sum, ($num1 + $num2));
    }

    public function sumProvider()
    {
        /*Array key is the "named dataprovider" and will be useful
        in identifying right dataset in big dataset.*/

        return [
            [1, 1, 2],
            [2, 3, 5],
            '12 plus 90' => [12, 90, 102],
            '90 plus 10' => [90, 10, 100]
        ];
    }
}