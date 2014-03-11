<?php
namespace SGH\PdfBox;

/**
 * Interface for conversion from PDF documents to text or HTML
 *
 * @author Fabian Schmengler <fschmengler@sgh-it.eu>
 * @copyright SGH informationstechnologie UGmbh 2011-2014
 * @category SGH
 * @package PdfBox
 *
 */
interface PdfConverter
{
    /**
     * Convert PDF file to plain text
     *
     * @param string $filename   path to input file
     * @param string $saveToFile path to output text file, null if it should not be saved
     * @return string converted text
     */
    public function textFromPdfFile($filename, $saveToFile = null);
    /**
     * Convert PDF to plain text
     *
     * @param string $content    PDF as binary string
     * @param string $saveToFile path to output text file, null if it should not be saved
     * @return string converted text
     */
    public function textFromPdfStream($content, $saveToFile = null);
    /**
     * Convert PDF file to HTML
     *
     * @param string $filename   path to input file
     * @param string $saveToFile path to output HTML file, null if it should not be saved
     * @return string converted HTML
     */
    public function htmlFromPdfFile($filename, $saveToFile = null);
    /**
     * Convert PDF to HTML
     *
     * @param string $content    PDF as binary string
     * @param string $saveToFile path to output HTML file, null if it should not be saved
     * @return string converted HTML
     */
    public function htmlFromPdfStream($content, $saveToFile = null);
    /**
     * Convert PDF file to DOM document
     *
     * @param string $filename   path to input file
     * @param string $saveToFile path to output HTML file, null if it should not be saved
     * @return \DOMDocument
     */
    public function domFromPdfFile($filename, $saveToFile = null);
    /**
     * Convert PDF to DOM document
     *
     * @param string $content    PDF as binary string
     * @param string $saveToFile path to output HTML file, null if it should not be saved
     * @return \DOMDocument
     */
    public function domFromPdfStream($content, $saveToFile = null);

}