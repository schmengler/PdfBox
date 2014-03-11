<?php
namespace SGH\PdfBox;
/**
 * Contains options for the Command class
 *
 * @author Fabian Schmengler <fschmengler@sgh-it.eu>
 * @copyright SGH informationstechnologie UGmbh 2011-2014
 * @category SGH
 * @package PdfBox
 * @link http://pdfbox.apache.org/commandline/#extractText
 *
 */
class Options
{
    /**
     * @var bool
     */
    protected $sort = false;
    /**
     * @var bool
     */
    protected $ignoreBeads = false;
    /**
     * @var bool
     */
    protected $force = false;
    /**
     * @var int
     */
    protected $startPage = 1;
    /**
     * @var int
     */
    protected $endPage = PHP_INT_MAX;

    /**
     * @return bool $sort
     */
    public function getSort() {
        return $this->sort;
    }

    /**
     * @return bool $ignoreBeads
     */
    public function getIgnoreBeads() {
        return $this->ignoreBeads;
    }

    /**
     * @return bool $force
     */
    public function getForce() {
        return $this->force;
    }

    /**
     * @return int $startPage
     */
    public function getStartPage() {
        return $this->startPage;
    }

    /**
     * @return int $endPage
     */
    public function getEndPage() {
        return $this->endPage;
    }

    /**
     * Sort the text before writing.
     *
     * @param bool $sort
     */
    public function setSort($sort) {
        $this->sort = (bool) $sort;
        return $this;
    }

    /**
     * Disables the separation by beads.
     *
     * @param bool $ignoreBeads
     */
    public function setIgnoreBeads($ignoreBeads) {
        $this->ignoreBeads = (bool) $ignoreBeads;
        return $this;
    }

    /**
     * Enables pdfbox to ignore corrupt objects.
     *
     * @param bool $force
     */
    public function setForce($force) {
        $this->force = (bool) $force;
        return $this;
    }

    /**
     * Set the first page to extract, one based.
     *
     * @param int $startPage
     */
    public function setStartPage($startPage) {
        $this->startPage = (int) $startPage;
        return $this;
    }

    /**
     * Set the last page to extract, one based.
     *
     * @param int $endPage
     */
    public function setEndPage($endPage) {
        $this->endPage = (int) $endPage;
        return $this;
    }
}