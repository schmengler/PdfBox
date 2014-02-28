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
    protected $_jar = 'pdfbox.jar';
    
    protected $_options;
    
    protected $_asHtml = false;
    
    protected $_toConsole = false;
    
    protected $_pdfFile;
    
    protected $_textFile;
    
    protected $_pdfFileIsTemp = false;
    
    protected $_textFileIsTemp = false;
    
    public function __construct()
    {
        $this->_options = new Options();
    }
    
    public function __toString()
    {
        return preg_replace('/\s+/', ' ', sprintf(
            'java -jar %s ExtractText %s %s %s %s',
            escapeshellarg($this->_jar), $this->getBasicOptions(), $this->getUserOptions(),
            escapeshellarg($this->_pdfFile), escapeshellarg($this->_textFile)
        ));
    }
    
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
     * @return string path to jar file
     */
    public function getJar()
    {
        return $this->_jar;
    }
    /**
     * @return Options
     */
    public function getOptions()
    {
        return $this->_options;
    }
    /**
     * @return the $pdfFile
     */
    public function getPdfFile() {
        return $this->_pdfFile;
    }

    /**
     * @return the $textFile
     */
    public function getTextFile() {
        return $this->_textFile;
    }

    /**
     * @return the $pdfFile
     */
    public function getPdfFileIsTemp() {
        return $this->_pdfFileIsTemp;
    }

    /**
     * @return the $textFile
     */
    public function getTextFileIsTemp() {
        return $this->_textFileIsTemp;
    }
    
    /**
     * @return the $asHtml
     */
    public function getAsHtml() {
        return $this->_asHtml;
    }

    /**
     * @return the $toConsole
     */
    public function getToConsole() {
        return $this->_toConsole;
    }
    
    public function setJar($jar)
    {
        $this->_jar = $jar;
        return $this;
    }

    public function setOptions(Options $options)
    {
        $this->_options = $options;
        return $this;
    }
    /**
     * @param field_type $pdfFile
     */
    public function setPdfFile($pdfFile, $isTemp = false) {
        $this->_pdfFile = $pdfFile;
        $this->_pdfFileIsTemp = (bool) $isTemp;
        return $this;
    }

    /**
     * @param field_type $textFile
     */
    public function setTextFile($textFile, $isTemp = false) {
        $this->_textFile = $textFile;
        $this->_textFileIsTemp = (bool) $isTemp;
        return $this;
    }

    /**
     * @param field_type $asHtml
     */
    public function setAsHtml($asHtml) {
        $this->_asHtml = (bool) $asHtml;
        return $this;
    }

    /**
     * @param field_type $toConsole
     */
    public function setToConsole($toConsole) {
        $this->_toConsole = (bool) $toConsole;
        return $this;
    }

}