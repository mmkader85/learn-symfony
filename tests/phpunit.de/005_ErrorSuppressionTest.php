<?php

namespace PhpunitDe\Tests;

use PHPUnit\Framework\TestCase;

class ErrorSuppressionTest extends TestCase
{
    public function testSuppress()
    {
        $writer = new FileWriter();
        static::assertFalse(@$writer->write('/dir_not_exists/file_not_writable.php'), 'File Writable');
    }
}

class FileWriter
{
    public function write($file)
    {
        $fh = fopen($file, 'w');
        if (false == $fh) {
            return false;
        }

        return true;
    }
}