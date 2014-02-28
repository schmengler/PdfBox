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
    public function textFromPdfFile($filename, $saveToFile = null);
    
    public function textFromPdfStream($content, $saveToFile = null);
    
    public function htmlFromPdfFile($filename, $saveToFile = null);
    
    public function htmlFromPdfStream($content, $saveToFile = null);
    
    public function domFromPdfFile($filename, $saveToFile = null);
    
    public function domFromPdfStream($content, $saveToFile = null);

}