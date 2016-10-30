<?php

namespace AbdulBundle\Tests\Util;

use AbdulBundle\Util\ClassForMockTest;

class CalculatorTest extends \PHPUnit_Framework_TestCase
{
    public function testAdd()
    {
        $calculator = new ClassForMockTest();
        $sum = $calculator->add(20, 10);

        $this->assertEquals(30, $sum);
    }
}