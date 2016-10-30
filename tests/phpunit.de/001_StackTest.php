<?php

namespace PhpunitDe\Tests;

use PHPUnit\Framework\TestCase;

class StackTest extends TestCase
{
    public function testPushAndPop()
    {
        $stack = [];
        static::assertEquals(0, count($stack));

        array_push($stack, 'foo');
        static::assertEquals('foo', $stack[count($stack)-1]);
        static::assertEquals(1, count($stack));

        static::assertEquals('foo', array_pop($stack));
        static::assertEquals(0, count($stack));
    }
}
