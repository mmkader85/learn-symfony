<?php

namespace Tests\AbdulBundle\Util;

use AbdulBundle\Util\Calculator;

class CalculatorTest extends \PHPUnit_Framework_TestCase
{
    public function testAdd()
    {
        $calculator = new Calculator();
        $sum = $calculator->add(20, 10);

        $this->assertEquals(30, $sum);
    }
}