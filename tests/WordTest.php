<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class WordTest extends TestCase
{
    public function testWordDocument(): void
    {
        $phpword = new PHPWord2Text();
        $txt = $phpword->extractText('./tests/test1.docx');
        $txtToFind = "Table cell3";

        $this->assertTrue(strpos($txt, $txtToFind)!==FALSE);
        //$this->assertInstanceOf(
        //    Email::class,
        //    Email::fromString('user@example.com')
        //);
    }
}
