<?php

require_once 'PHPUnit\Framework\TestSuite.php';

require_once 'CommandTest.php';
require_once 'PdfBoxTest.php';

/**
 * Static test suite.
 * 
 * @author Fabian Schmengler <fschmengler@sgh-it.eu>
 * @copyright SGH informationstechnologie UGmbh 2011-2014
 * @category SGH
 * @package PdfBox
 * 
 */
class TestSuite extends PHPUnit_Framework_TestSuite {
    
    /**
     * Constructs the test suite handler.
     */
    public function __construct() {
        $this->setName ( 'TestSuite' );
        
        $this->addTestSuite ( 'CommandTest' );
        
        $this->addTestSuite ( 'PdfBoxTest' );
    
    }
    
    /**
     * Creates the suite.
     */
    public static function suite() {
        return new self ();
    }
}

