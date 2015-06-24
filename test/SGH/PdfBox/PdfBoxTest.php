<?php

namespace SGH\PdfBox;

/**
 * PdfBox test case. Needs Java and PdfBox
 *
 * @author Fabian Schmengler <fschmengler@sgh-it.eu>
 * @copyright SGH informationstechnologie UGmbh 2011-2014
 * @category SGH
 * @package PdfBox
 *
 */
class PdfBoxTest extends \PHPUnit_Framework_DOMTestCase
{
    /**
     * @var string
     */
    private $jar;

    /**
     * @var PdfBox
     */
    private $PdfBox;
    
    /**
     * @var string
     */
    private $pdfBoxVersion;

    /**
     * Content of test.pdf as text
     *
     * @var string
     */
    private static $expectedText = <<<TXT
Test-Dokument
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

TXT;

    private static $expectedHtml185 = <<<HTML
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html><head><title>Test-Dokument</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<div style="page-break-before:always; page-break-after:always"><div><p><b>Test-Dokument
</b>Also Zoidberg. Yes, if you make it look like an electrical fire. When you do things right, people
won't be sure you've done anything at all. Alright, let's mafia things up a bit. Joey, burn down the
ship. Clamps, burn down the crew.
</p>
<p><b>The Cryonic Woman
</b>So, how 'bout them Knicks? She also liked to shut up! I was all of history's great robot actors -
Acting Unit 0.8; Thespomat; David Duchovny! You, minion. Lift my arm. AFTER HIM!
</p>
<p>&#8226; She also liked to shut up!
&#8226; Now that the, uh, garbage ball is in space, Doctor, perhaps you can help me with my sexual
inhibitions?
</p>
<p>Eins Zwei Drei Vier F&#252;nf Sechs
Polizei Grenadier Alte Hex'</p>

</div></div>
</body></html>
HTML;

    private static $expectedHtmlFrom183 = <<<HTML
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html><head><title>Test-Dokument</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<div style="page-break-before:always; page-break-after:always"><div><p><b>Test-Dokument
</b>Also Zoidberg. Yes, if you make it look like an electrical fire. When you do things right, people
won't be sure you've done anything at all. Alright, let's mafia things up a bit. Joey, burn down the
ship. Clamps, burn down the crew.
</p>
<p><b>The Cryonic Woman
</b>So, how 'bout them Knicks? She also liked to shut up! I was all of history's great robot actors -
Acting Unit 0.8; Thespomat; David Duchovny! You, minion. Lift my arm. AFTER HIM!
</p>
<p>&#8226; She also liked to shut up!
&#8226; Now that the, uh, garbage ball is in space, Doctor, perhaps you can help me with my sexual
</p>
<p>inhibitions?
</p>
<p>Eins Zwei Drei Vier F&#252;nf Sechs
Polizei Grenadier Alte Hex'</p>

</div></div>
</body></html>
HTML;

    private static $expectedHtmlFrom180To182 = <<<HTML
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html><head><title>Test-Dokument</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<div style="page-break-before:always; page-break-after:always"><div><p>Test-Dokument
Also Zoidberg. Yes, if you make it look like an electrical fire. When you do things right, people
won't be sure you've done anything at all. Alright, let's mafia things up a bit. Joey, burn down the
ship. Clamps, burn down the crew.
</p>
<p>The Cryonic Woman
So, how 'bout them Knicks? She also liked to shut up! I was all of history's great robot actors -
Acting Unit 0.8; Thespomat; David Duchovny! You, minion. Lift my arm. AFTER HIM!
</p>
<p>&#8226; She also liked to shut up!
&#8226; Now that the, uh, garbage ball is in space, Doctor, perhaps you can help me with my sexual
</p>
<p>inhibitions?
</p>
<p>Eins Zwei Drei Vier F&#252;nf Sechs
Polizei Grenadier Alte Hex'</p>

</div></div>
</body></html>
HTML;

    private static $expectedHtmlFrom140To171 = <<<HTML
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html><head><title>Test-Dokument</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<div style="page-break-before:always; page-break-after:always"><div><p>Test-Dokument
Also Zoidberg. Yes, if you make it look like an electrical fire. When you do things right, people
won't be sure you've done anything at all. Alright, let's mafia things up a bit. Joey, burn down the
ship. Clamps, burn down the crew.
</p>
<p>The Cryonic Woman
So, how 'bout them Knicks? She also liked to shut up! I was all of history's great robot actors -
Acting Unit 0.8; Thespomat; David Duchovny! You, minion. Lift my arm. AFTER HIM!
</p>
<p>&#8226; She also liked to shut up!
&#8226; Now that the, uh, garbage ball is in space, Doctor, perhaps you can help me with my sexual
inhibitions?
</p>
<p>Eins Zwei Drei Vier F&#252;nf Sechs
Polizei Grenadier Alte Hex'</p>

</div></div>
</body></html>
HTML;

    private static $expectedHtml131 = <<<HTML
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html><head><title>Test-Dokument</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<div style="page-break-before:always; page-break-after:always"><div><p>Test-Dokument
Also Zoidberg. Yes, if you make it look like an electrical fire. When you do things right, people
won't be sure you've done anything at all. Alright, let's mafia things up a bit. Joey, burn down the
</p>
<p>ship. Clamps, burn down the crew.
</p>
<p>The Cryonic Woman
</p>
<p>So, how 'bout them Knicks? She also liked to shut up! I was all of history's great robot actors -
Acting Unit 0.8; Thespomat; David Duchovny! You, minion. Lift my arm. AFTER HIM!
</p>
<p>&#8226; She also liked to shut up!
</p>
<p>&#8226; Now that the, uh, garbage ball is in space, Doctor, perhaps you can help me with my sexual
</p>
<p>inhibitions?
</p>
<p>Eins Zwei Drei Vier F&#252;nf Sechs
</p>
<p>Polizei Grenadier Alte Hex'</p>

</div></div>
</body></html>
HTML;

    private static $expectedHtmlFrom120To121 = <<<HTML
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html><head><title>Test-Dokument</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<div>Test-Dokument<br>
Also Zoidberg. Yes, if you make it look like an electrical fire. When you do things right, people
<br>
won't be sure you've done anything at all. Alright, let's mafia things up a bit. Joey, burn down the
<br>
ship. Clamps, burn down the crew.<br>
The Cryonic Woman<br>
So, how 'bout them Knicks? She also liked to shut up! I was all of history's great robot actors -
<br>
Acting Unit 0.8; Thespomat; David Duchovny! You, minion. Lift my arm. AFTER HIM!<br> &#8226; She also liked to shut up!
<br>
&#8226; Now that the, uh, garbage ball is in space, Doctor, perhaps you can help me with my sexual
<br>
inhibitions?
<br>
Eins Zwei Drei Vier F&#252;nf Sechs<br> Polizei Grenadier Alte Hex'</div>
</body></html>
HTML;

    /**
     * Prepares the environment before running a test. The pdfbox-jar environemnt variable
     * can be set in phpunit.xml to specify the path to the PdfBox jar file
     */
    protected function setUp()
    {
        parent::setUp();

        $this->jar = getenv('PDFBOX_JAR');
        if ($this->jar !== false) {
            $this->PdfBox = new PdfBox();
        } else {
            $this->markTestSkipped('PDFBOX_JAR is not set.');
        }
        preg_match('/-([\d\.]+).jar$/', $this->jar, $matches);
        $this->pdfBoxVersion = $matches[1];
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
        exec('java -jar ' . escapeshellarg($this->jar) . ' 2>&1', $stdErrLines, $exitCode);
        $stdErr = implode(PHP_EOL, $stdErrLines);

        $this->assertEquals(1, $exitCode, 'exit code');
        $this->assertRegExp('/^Usage: java pdfbox-app-x.y.z.jar <command> <args..>$/mi', $stdErr, 'PdfBox output');
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
        $this->assertSelectEquals('html > head > title', 'Test-Dokument', 1, $dom);
        $headlineSelector = 'p b';
        $paragraphSelector = 'p';
        if (version_compare($this->pdfBoxVersion, '1.8.2', '<=')) {
            $headlineSelector = 'p';
        }
        if (version_compare($this->pdfBoxVersion, '1.2.1', '<=')) {
            $headlineSelector = 'div';
            $paragraphSelector = 'div';
        }
        $this->assertSelectRegExp($headlineSelector, '/Test-Dokument/', 1, $dom);
        $this->assertSelectRegExp($headlineSelector, '/The Cryonic Woman/', 1, $dom);
        $this->assertSelectRegExp($paragraphSelector, '/inhibitions/', 1, $dom);
    }

    /**
     * Tests PdfBox->domFromPdfStream()
     *
     * @test
     * @depends testDomFromPdfFile
     */
    public function testDomFromPdfStream()
    {
        $this->PdfBox->setPathToPdfBox($this->jar);
        $expectedDom = $this->PdfBox->domFromPdfFile(__DIR__ . '/test.pdf');
        $dom = $this->PdfBox->domFromPdfStream(file_get_contents(__DIR__ . '/test.pdf'));
        $this->assertInstanceOf('\DOMDocument', $dom);
        $this->assertEquals($expectedDom->saveHTML(), $dom->saveHTML());
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
        $this->assertEqualsIgnoreWhitespace($this->getExpectedHtml(), $html);
    }

    /**
     * Tests PdfBox->htmlFromPdfStream()
     *
     * @test
     * @depends testExec
     */
    public function testHtmlFromPdfStream()
    {
        $this->PdfBox->setPathToPdfBox($this->jar);
        $html = $this->PdfBox->htmlFromPdfStream(file_get_contents(__DIR__ . '/test.pdf'));
        $this->assertEqualsIgnoreWhitespace($this->getExpectedHtml(), $html);
    }
    
    private function getExpectedHtml()
    {
        $expectedHtml = self::$expectedHtmlFrom183;
        if ($this->pdfBoxVersion === '1.8.5') {
            $expectedHtml = self::$expectedHtml185;
        }
        if (version_compare($this->pdfBoxVersion, '1.8.2', '<=')) {
            $expectedHtml = self::$expectedHtmlFrom180To182;
        }
        if (version_compare($this->pdfBoxVersion, '1.7.1', '<=')) {
            $expectedHtml = self::$expectedHtmlFrom140To171;
        }
        if (version_compare($this->pdfBoxVersion, '1.3.1', '<=')) {
            $expectedHtml = self::$expectedHtml131;
        }
        if (version_compare($this->pdfBoxVersion, '1.2.1', '<=')) {
            $expectedHtml = self::$expectedHtmlFrom120To121;
        }
        return $expectedHtml;
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
        $this->assertEqualsIgnoreWhitespace(self::$expectedText, $text);
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
        $this->assertEqualsIgnoreWhitespace(self::$expectedText, $text);
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

    /**
     * Assert two strings are equal, ignoring white space changes.
     * Any sequence of 1 or more white spaces is treaten equal.
     *
     * @param string $expected
     * @param string $actual
     * @param string $message
     */
    public static function assertEqualsIgnoreWhitespace($expected, $actual, $message = '')
    {
        $expected = preg_replace('/\s+/', ' ', $expected);
        $actual = preg_replace('/\s+/', ' ', $actual);

        return self::assertEquals($expected, $actual, $message);
    }
}
