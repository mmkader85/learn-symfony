<?php

namespace PhpunitDe\Tests;

use PHPUnit\Framework\TestCase;

class ExpectedExceptionTest extends TestCase
{
    /**
     * @expectedException PHPUnit_Framework_Error
     */
    public function testException()
    {
        include 'it_doesnt_exit.php';
    }
}
