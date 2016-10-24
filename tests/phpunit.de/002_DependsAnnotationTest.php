<?php

namespace PhpunitDe\Tests;

class DependsAnnotationTest extends \PHPUnit_Framework_TestCase
{
    public function testEmpty()
    {
        $fruits = [];
        static::assertCount(0, $fruits);

        return $fruits;
    }

    /**
     * @param array $fruits
     * @depends testEmpty
     * @return array $fruits
     */
    public function testPush(array $fruits)
    {
        $newFruit = 'Apple';
        array_push($fruits, $newFruit);
        static::assertEquals($newFruit, $fruits[count($fruits)-1], 'Array push failed - New fruit has not been pushed');

        return $fruits;
    }

    /**
     * @param array $fruits
     * @depends testPush
     */
    public function testPop(array $fruits)
    {
        static::assertEquals('Apple', array_pop($fruits), 'Array pop failed - New fruit has not been popped');
    }
}