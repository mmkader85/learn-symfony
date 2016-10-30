<?php

namespace AbdulBundle\Tests\Util;

use AbdulBundle\Util\ClassForMockTest;

class ClassForMockTestTest extends \PHPUnit_Framework_TestCase
{
    public function testAdd()
    {
        $objMockTest = new ClassForMockTest();
        $sum = $objMockTest->add(20, 10);

        static::assertEquals(30, $sum);
    }

    public function testGetFirstArgument()
    {
        $objMockTest = new ClassForMockTest();
        $firstArg = $objMockTest->getFirstArgument('foo', 'bar');

        static::assertEquals('foo', $firstArg);
    }
}