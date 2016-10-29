<?php

namespace PhpunitDe\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Class ErrorSuppressionTest
 * @package PhpunitDe\Tests
 */
class ErrorSuppressionTest extends TestCase
{
    /**
     * @group Group 1
     */
    public function testSuppress()
    {
        $writer = new FileWriter();
        static::assertFalse(@$writer->write('/dir_not_exists/file_not_writable.php'), 'File Writable');
    }
}

/**
 * Class FileWriter
 * @package PhpunitDe\Tests
 */
class FileWriter
{
    /**
     * @param $file
     * @return bool
     */
    public function write($file)
    {
        $fh = fopen($file, 'w');
        if (false == $fh) {
            return false;
        }

        return true;
    }
}