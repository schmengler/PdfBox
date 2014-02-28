<?php
namespace SGH\PdfBox;

require_once 'PHPUnit\Framework\TestCase.php';

require_once '../Command.php';
require_once '../Options.php';

/**
 * Test case for Command class.
 * 
 * @author Fabian Schmengler <fschmengler@sgh-it.eu>
 * @copyright SGH informationstechnologie UGmbh 2011-2014
 * @category SGH
 * @package PdfBox
 * 
 */
class CommandTest extends \PHPUnit_Framework_TestCase {
    
    /**
     * @var Command
     */
    private $Command;
    
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->Command = new Command(/* parameters */);
        $this->Command->setPdfFile('in.pdf');
        $this->Command->setTextFile('out.txt');
    }
    
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->Command = null;
        parent::tearDown ();
    }

    /**
     * 
     */
    public function testDefault()
    {
        $cmd = $this->Command->__toString();
        $this->assertEquals('java -jar pdfbox-app-1.6.0.jar ExtractText in.pdf out.txt', $cmd);
    }

    public function testHtmlToConsole()
    {
        $this->Command->setAsHtml(true);
        $this->Command->setToConsole(true);
        $cmd = $this->Command->__toString();
        $this->assertEquals('java -jar pdfbox-app-1.6.0.jar ExtractText -html -console in.pdf out.txt', $cmd);
    }
    
    public function testSomeOptions()
    {
        $this->Command->setAsHtml(true);
        $this->Command->getOptions()
            ->setForce(true)
            ->setStartPage(2)
            ->setEndPage(10);
        $cmd = $this->Command->__toString();
        $this->assertEquals('java -jar pdfbox-app-1.6.0.jar ExtractText -html -force -startPage 2 -endPage 10 in.pdf out.txt', $cmd);
    }
    
    public function testPath()
    {
        $this->Command->setJar('/path/to/pdfbox.jar');
        $cmd = $this->Command->__toString();
        $this->assertEquals('java -jar /path/to/pdfbox.jar ExtractText in.pdf out.txt', $cmd);
    }
}

