<?php
namespace SGH\PdfBox;

/**
 * PDF converter implemention with PdfBox
 * 
 * @author Fabian Schmengler <fschmengler@sgh-it.eu>
 * @copyright SGH informationstechnologie UGmbh 2011-2014
 * @category SGH
 * @package PdfBox
 *
 */
class PdfBox implements PdfConverter
{
    /**
     * @var string
     */
    protected $_pathToPdfBox = 'pdfbox-app-1.6.0.jar';
    /**
     * @var Options
     */
    protected $_options;
    /**
     * @var string
     */
    protected $_pdfFile;
    
    
    /* (non-PHPdoc)
     * @see SGH\PdfBox.PdfConverter::domFromPdfFile()
     */
    public function domFromPdfFile($filename, $saveToFile = null)
    {
        $dom = new \DOMDocument();
        $dom->loadHTML($this->htmlFromPdfFile($filename, $saveToFile));
        return $dom;
    }

    /* (non-PHPdoc)
     * @see SGH\PdfBox.PdfConverter::domFromPdfStream()
     */
    public function domFromPdfStream($content, $saveToFile = null)
    {
        $dom = new \DOMDocument();
        $dom->loadHTML($this->htmlFromPdfStream($content, $saveToFile));
        return $dom;
    }

    /* (non-PHPdoc)
     * @see SGH\PdfBox.PdfConverter::htmlFromPdfFile()
     */
    public function htmlFromPdfFile($filename, $saveToFile = null)
    {
        $command = $this->prepareCommand($filename, $saveToFile);
        $command->setAsHtml(true);
        return $this->execute($command);
    }

    /* (non-PHPdoc)
     * @see SGH\PdfBox.PdfConverter::htmlFromPdfStream()
     */
    public function htmlFromPdfStream($content, $saveToFile = null)
    {
        $temp = tempnam(__DIR__, 'pdfbox');
        file_put_contents($temp, $content);
        $command = $this->prepareCommand($temp, $saveToFile, true);
        $command->setAsHtml(true);
        return $this->execute($command);
    }

    /* (non-PHPdoc)
     * @see SGH\PdfBox.PdfConverter::textFromPdfFile()
     */
    public function textFromPdfFile($filename, $saveToFile = null)
    {
        $command = $this->prepareCommand($filename, $saveToFile);
        return $this->execute($command);
    }
    
    /* (non-PHPdoc)
     * @see SGH\PdfBox.PdfConverter::textFromPdfStream()
     */
    public function textFromPdfStream($content, $saveToFile = null)
    {
        $temp = tempnam(__DIR__, 'pdfbox');
        file_put_contents($temp, $content);
        $command = $this->prepareCommand($temp, $saveToFile, true);
        return $this->execute($command);
    }

    public function __construct()
    {
        $this->resetOptions();
    }
    
    public function resetOptions()
    {
        $this->_options = new Options();
    }
    
    protected function prepareCommand($filename, $saveToFile, $pdfIsTemp = false)
    {
        $resultIsTemp = false;
        $command = new Command();
        $command->setPdfFile($filename, $pdfIsTemp);
        if ($saveToFile === null) {
        	//FIXME tmp dir \w space results in java.filenotfound exception
            $saveToFile = tempnam(__DIR__, 'pdfbox');
            $resultIsTemp = true;
        }
        $command->setTextFile($saveToFile, $resultIsTemp);
        return $command;
    }

    protected function execute(Command $command)
    {
        $command->setJar($this->getPathToPdfBox());
        $command->setOptions($this->_options);
        exec((string) $command . ' 2>&1', $stdErr, $exitCode);
        if ($exitCode > 0) {
            throw new \RuntimeException(join("\n", $stdErr), $exitCode);
        }
        $resultFile = $command->getTextFile();
        $result = file_get_contents($resultFile);
        if ($command->getTextFileIsTemp()) {
            unlink($resultFile);
        }
        if ($command->getPdfFileIsTemp()) {
            unlink($command->getPdfFile());
        }
        return $result;
    }
    public function getOptions()
    {
        return $this->_options;
    }
    /**
     * @return the $_pathToPdfBox
     */
    public function getPathToPdfBox()
    {
        return $this->_pathToPdfBox;
    }

    /**
     * @param string $_pathToPdfBox
     */
    public function setPathToPdfBox($_pathToPdfBox)
    {
        $this->_pathToPdfBox = $_pathToPdfBox;
    }

}