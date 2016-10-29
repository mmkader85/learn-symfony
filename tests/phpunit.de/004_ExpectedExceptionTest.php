<?php

namespace PhpunitDe\Tests;

use PHPUnit\Framework\TestCase;

class ExpectedExceptionTest extends TestCase
{
    /**
     * @group Group 1
     * @expectedException PHPUnit_Framework_Error
     */
    public function testException()
    {
        include 'it_doesnt_exit.php';
    }
}
