<?php

namespace PhpunitDe\Tests;

use PHPUnit\Framework\TestCase;

class CannotBeZeroException extends \Exception
{
}

class ExpectedExceptionTest extends TestCase
{
    /**
     * @expectedException CannotBeZeroException
     */
    public function testException()
    {
        throw new CannotBeZeroException('User ID cannot be zero');
    }
}
