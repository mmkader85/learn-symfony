<?php

namespace PhpunitDe\Tests;

use PHPUnit\Framework\TestCase;

class ExpectOutputTest extends TestCase
{
    public function testOutput()
    {
        new Writer('Print This');
        static::expectOutputString('Print This'); //or static::expectOutputRegex('/^[a-z ]+$/i');
    }
}

class Writer
{
    public function __construct($string)
    {
        echo $string;
    }
}