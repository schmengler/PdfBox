<?php
namespace SGH\PdfBox;

require_once 'PHPUnit\Framework\TestCase.php';

require_once '../Command.php';
require_once '../Options.php';
require_once '../PdfConverter.php';
require_once '../PdfBox.php';


/**
 * PdfBox test case. Needs Java and PdfBox
 * 
 * @author Fabian Schmengler <fschmengler@sgh-it.eu>
 * @copyright SGH informationstechnologie UGmbh 2011-2014
 * @category SGH
 * @package PdfBox
 * 
 */
class PdfBoxTest extends \PHPUnit_Framework_TestCase {
    
    private $jar = 'pdfbox-app-1.6.0.jar';
    
    /**
     * @var PdfBox
     */
    private $PdfBox;
    
    /**
     * Content of test.pdf as text
     * 
     * @var string 
     */
    private static $expectedText = "Test-Dokument
Also Zoidberg. Yes, if you make it look like an electrical fire. When you do things right, people 
won't be sure you've done anything at all. Alright, let's mafia things up a bit. Joey, burn down the 
ship. Clamps, burn down the crew.
The Cryonic Woman
So, how 'bout them Knicks? She also liked to shut up! I was all of history's great robot actors - 
Acting Unit 0.8; Thespomat; David Duchovny! You, minion. Lift my arm. AFTER HIM!
• She also liked to shut up! 
• Now that the, uh, garbage ball is in space, Doctor, perhaps you can help me with my sexual 
inhibitions? 
Eins Zwei Drei Vier Fünf Sechs
Polizei Grenadier Alte Hex'
";
    
    /**
     * Prepares the environment before running a test. The pdfbox-jar environemnt variable
     * can be set in phpunit.xml to specify the path to the PdfBox jar file
     */
    protected function setUp()
    {
        parent::setUp();
        $this->jar = getenv('pdfbox-jar') ?: $this->jar;
        $this->PdfBox = new PdfBox();
    }
    
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->PdfBox = null;
        parent::tearDown();
    }
    
    /**
     * Test if PdfBox is available
     * 
     * @test
     */
    public function testExec()
    {
        exec('java -jar ' . escapeshellarg($this->jar) . ' 2>&1', $stdErr, $exitCode);
        $this->assertEquals(1, $exitCode, 'exit code');
        $this->assertEquals(array('usage: java pdfbox-app-x.y.z.jar <command> <args..>'), $stdErr, 'pdfbox output');
    }
    
    /**
     * Tests PdfBox->domFromPdfFile()
     * 
     * @test
     * @depends testExec
     */
    public function testDomFromPdfFile()
    {
        $this->PdfBox->setPathToPdfBox($this->jar);
        $dom = $this->PdfBox->domFromPdfFile(__DIR__ . '/test.pdf');
        $this->assertInstanceOf('\DOMDocument', $dom);
        //TODO test as needed
    }
    
    /**
     * Tests PdfBox->domFromPdfStream()
     *
     * @test
     * @depends testExec
     */
    public function testDomFromPdfStream()
    {
        $this->PdfBox->setPathToPdfBox($this->jar);
        $dom = $this->PdfBox->domFromPdfStream(file_get_contents(__DIR__ . '/test.pdf'));
        $this->assertInstanceOf('\DOMDocument', $dom);
        //TODO test as needed
    }
    
    /**
     * Tests PdfBox->htmlFromPdfFile()
     * 
     * @test
     * @depends testExec
     */
    public function testHtmlFromPdfFile()
    {
        $this->PdfBox->setPathToPdfBox($this->jar);
        $html = $this->PdfBox->htmlFromPdfFile(__DIR__ . '/test.pdf');
        var_dump($html);
        $this->markTestSkipped('not very useful feature atm'); //TODO test as needed
    }
    
    /**
     * Tests PdfBox->htmlFromPdfStream()
     * 
     * @test
     * @depends testExec
     */
    public function testHtmlFromPdfStream()
    {
        $this->markTestSkipped('not very useful feature atm'); //TODO test as needed
    }
    
    /**
     * Tests PdfBox->textFromPdfFile()
     * 
     * @test
     * @depends testExec
     */
    public function testTextFromPdfFile()
    {
        $this->PdfBox->setPathToPdfBox($this->jar);
        $text = $this->PdfBox->textFromPdfFile(__DIR__ . '/test.pdf');
        $this->assertEquals(self::$expectedText, $text);
    }
    
    /**
     * Tests PdfBox->textFromPdfStream()
     * 
     * @test
     * @depends testExec
     */
    public function testTextFromPdfStream()
    {
        $this->PdfBox->setPathToPdfBox($this->jar);
        $text = $this->PdfBox->textFromPdfStream(file_get_contents(__DIR__ . '/test.pdf'));
        $this->assertEquals(self::$expectedText, $text);
    }

    /**
     * Tests exception for wrong path to PdfBox
     * 
     * @test
     * @depends testExec
     * @expectedException RuntimeException
     */
    public function testPdfBoxMissingException()
    {
        $this->PdfBox->setPathToPdfBox('garrbllblbl');
        $this->PdfBox->textFromPdfFile(__DIR__ . '/test.pdf');
    }

}

