<?php
namespace SGH\PdfBox;
/**
 * Contains options for the Command class
 * 
 * @author Fabian Schmengler <fschmengler@sgh-it.eu>
 * @copyright SGH informationstechnologie UGmbh 2011-2014
 * @category SGH
 * @package PdfBox
 *
 */
class Options
{
    protected $sort = false;
    
    protected $ignoreBeads = false;
    
    protected $force = false;
    
    protected $startPage = 1;
    
    protected $endPage = PHP_INT_MAX;
    
    /**
     * @return the $sort
     */
    public function getSort() {
        return $this->sort;
    }

    /**
     * @return the $ignoreBeads
     */
    public function getIgnoreBeads() {
        return $this->ignoreBeads;
    }

    /**
     * @return the $force
     */
    public function getForce() {
        return $this->force;
    }

    /**
     * @return the $startPage
     */
    public function getStartPage() {
        return $this->startPage;
    }

    /**
     * @return the $endPage
     */
    public function getEndPage() {
        return $this->endPage;
    }

    /**
     * @param field_type $sort
     */
    public function setSort($sort) {
        $this->sort = (bool) $sort;
        return $this;
    }

    /**
     * @param field_type $ignoreBeads
     */
    public function setIgnoreBeads($ignoreBeads) {
        $this->ignoreBeads = (bool) $ignoreBeads;
        return $this;
    }

    /**
     * @param field_type $force
     */
    public function setForce($force) {
        $this->force = (bool) $force;
        return $this;
    }

    /**
     * @param field_type $startPage
     */
    public function setStartPage($startPage) {
        $this->startPage = (int) $startPage;
        return $this;
    }

    /**
     * @param field_type $endPage
     */
    public function setEndPage($endPage) {
        $this->endPage = (int) $endPage;
        return $this;
    }
}