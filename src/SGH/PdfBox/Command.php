<?php
namespace SGH\PdfBox;

/**
 * Represents a PdfBox command with parameters. The __toString() method returns the full command line
 *
 * @author Fabian Schmengler <fschmengler@sgh-it.eu>
 * @copyright SGH informationstechnologie UGmbh 2011-2014
 * @category SGH
 * @package PdfBox
 *
 */
class Command
{
    /**
     * @var string
     */
    protected $_jar = 'pdfbox.jar';
    /**
     * @var \SGH\PdfBox\Options
     */
    protected $_options;
    /**
     * @var bool
     */
    protected $_asHtml = false;
    /**
     * @var bool
     */
    protected $_toConsole = false;
    /**
     * @var string
     */
    protected $_pdfFile;
    /**
     * @var string
     */
    protected $_textFile;
    /**
     * @var bool
     */
    protected $_pdfFileIsTemp = false;
    /**
     * @var bool
     */
    protected $_textFileIsTemp = false;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->_options = new Options();
    }
    /**
     * Return full PdfBox command
     *
     * @return string
     */
    public function __toString()
    {
        return preg_replace('/\s+/', ' ', sprintf(
            'java -jar %s ExtractText %s %s %s %s',
            escapeshellarg($this->_jar), $this->getBasicOptions(), $this->getUserOptions(),
            escapeshellarg($this->_pdfFile), escapeshellarg($this->_textFile)
        ));
    }
    /**
     * Return array of basic command line options
     *
     * @return string[]
     */
    protected function getBasicOptions()
    {
        $options = array();
        $options[] = '-encoding UTF-8'; // funktioniert erwiesenerma�en, ABER NUR MIT DATEI, nicht mit Konsole! Also niemals konsole verwenden!
        if ($this->_asHtml) {
            $options[] = '-html';
        }
        if ($this->_toConsole) {
            $options[] = '-console';
        }
        return join(' ', $options);
    }

    /**
     * Return array of command line options based on $_options configuration object
     *
     * @return string[]
     */
    protected function getUserOptions()
    {
        $options = array();
        if ($this->_options->getSort()) {
            $options[] = '-sort';
        }
        if ($this->_options->getIgnoreBeads()) {
            $options[] = '-ignoreBeads';
        }
        if ($this->_options->getForce()) {
            $options[] = '-force';
        }
        if ($this->_options->getStartPage() > 1) {
            $options[] = '-startPage ' . $this->_options->getStartPage();
        }
        if ($this->_options->getEndPage() < PHP_INT_MAX) {
            $options[] = '-endPage ' . $this->_options->getEndPage();
        }
        return join(' ', $options);
    }
    /**
     * Return path to PdfBox jar file
     *
     * @return string path to jar file
     */
    public function getJar()
    {
        return $this->_jar;
    }
    /**
     * Return advanced options
     *
     * @return \SGH\PdfBox\Options configuration object
     */
    public function getOptions()
    {
        return $this->_options;
    }
    /**
     * Return path to input file (PDF)
     *
     * @return string $pdfFile
     */
    public function getPdfFile() {
        return $this->_pdfFile;
    }

    /**
     * Return path to output file (text or HTML)
     *
     * @return string $textFile
     */
    public function getTextFile() {
        return $this->_textFile;
    }

    /**
     * Return true if input file is temporary
     *
     * @return bool $pdfFileIsTemp
     */
    public function getPdfFileIsTemp() {
        return $this->_pdfFileIsTemp;
    }

    /**
     * Return true if output file is temporary
     *
     * @return bool $textFileIsTemp
     */
    public function getTextFileIsTemp() {
        return $this->_textFileIsTemp;
    }

    /**
     * Return output format: true if HTML, false if plain text
     *
     * @return bool $asHtml
     */
    public function getAsHtml() {
        return $this->_asHtml;
    }

    /**
     * Return output destination: true if console, false if file
     *
     * @return bool $toConsole
     */
    public function getToConsole() {
        return $this->_toConsole;
    }

    /**
     * Set path to PdfBox jar file
     *
     * @param string $jar Full path to PdfBox jar file
     * @return \SGH\PdfBox\Command
     */
    public function setJar($jar)
    {
        $this->_jar = $jar;
        return $this;
    }

    /**
     * Set advanced options
     *
     * @param Options $options Configuration object
     * @return \SGH\PdfBox\Command
     */
    public function setOptions(Options $options)
    {
        $this->_options = $options;
        return $this;
    }
    /**
     * Set input file (PDF)
     *
     * @param string $pdfFile Path to input file
     * @param bool   $isTemp  True if the file is a temporary file (Default: false)
     * @return \SGH\PdfBox\Command
     */
    public function setPdfFile($pdfFile, $isTemp = false) {
        $this->_pdfFile = $pdfFile;
        $this->_pdfFileIsTemp = (bool) $isTemp;
        return $this;
    }

    /**
     * Set output file (text or HTML)
     *
     * @param string $textFile Path to output file
     * @param bool   $isTemp   True if the file is a temporary file (Default: false)
     * @return \SGH\PdfBox\Command
     */
    public function setTextFile($textFile, $isTemp = false) {
        $this->_textFile = $textFile;
        $this->_textFileIsTemp = (bool) $isTemp;
        return $this;
    }

    /**
     * Set output format
     *
     * @param bool $asHtml true if output should be HTML, false if output should be plain text
     * @return \SGH\PdfBox\Command
     */
    public function setAsHtml($asHtml) {
        $this->_asHtml = (bool) $asHtml;
        return $this;
    }

    /**
     * Set output destination
     *
     * @param bool $toConsole true if output should go to console, false if output should go to specified file
     * @return \SGH\PdfBox\Command
     */
    public function setToConsole($toConsole) {
        $this->_toConsole = (bool) $toConsole;
        return $this;
    }

}