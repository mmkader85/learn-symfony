<?php

namespace AbdulBundle\Util;

/**
 * Class Calculator
 * @package AbdulBundle\Util
 * Chapter 12 - Testing
 */
class ClassForMockTest
{
    public function add($num1, $num2)
    {
        return $num1 + $num2;
    }

    public function getFirstArgument($arg1, $arg2)
    {
        return $arg1;
    }

    /**
     * @return $this
     * @codeCoverageIgnore
     */
    public function getClassObject()
    {
        return $this;
    }

    public function doSomething()
    {

    }
}