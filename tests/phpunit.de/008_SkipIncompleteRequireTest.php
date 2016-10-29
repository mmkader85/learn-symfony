<?php

namespace PhpunitDe\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Class SkipIncompleteRequireTest
 * @package PhpunitDe\Tests
 */
class SkipIncompleteRequireTest extends TestCase
{
    protected $extension;

    protected function setUp()
    {
        $this->extension = 'pcntl';
    }

    public function numProvider()
    {
        return [
            [0, 0],
            [5, 120]
        ];
    }

    /**
     * @param $num
     * @param $factorial
     * @dataProvider numProvider
     */
    public function testIncompleteFunction($num, $factorial)
    {
        if ($num >= 1) {
            static::assertEquals($factorial, $this->getFactorial($num));
        } else {
            static::markTestIncomplete('Testing mark incomplete');
        }
    }

    private function getFactorial($num)
    {
        $factorial = $num;
        do {
            $num -= 1;
            $factorial = $factorial * $num;
        } while ($num > 1);

        return $factorial;
    }

    public function testSkipFunction()
    {
        if (!extension_loaded($this->extension)) {
            // Use -v or --verbose to see this message in console
            static::markTestSkipped('Extension "' . $this->extension . '" not loaded. Test skipped.');
        }

        static::assertTrue(extension_loaded($this->extension));
    }

    /**
     * @requires extension pcntl
     * Possible values for requires are PHP, PHPUnit, OS, function, extension
     */
    public function testSkipRequires()
    {
        static::assertTrue(extension_loaded($this->extension));
    }
}