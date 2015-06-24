# PdfBox

A PHP interface for the [PdfBox ExtractText](http://pdfbox.apache.org/commandline/#extractText) utility, useful to unit-test contents of generated PDFs.

[![Build Status](https://travis-ci.org/schmengler/PdfBox.svg?branch=master)](https://travis-ci.org/schmengler/PdfBox) [![Latest Stable Version](https://poser.pugx.org/sgh/pdfbox/version)](https://packagist.org/packages/sgh/pdfbox) [![Latest Unstable Version](https://poser.pugx.org/sgh/pdfbox/v/unstable)](//packagist.org/packages/sgh/pdfbox) [![Total Downloads](https://poser.pugx.org/sgh/pdfbox/downloads)](https://packagist.org/packages/sgh/pdfbox) [![License](https://poser.pugx.org/sgh/pdfbox/license)](https://packagist.org/packages/sgh/pdfbox)
## Requirements
- PHP >=5.3 or HHVM
- Java Runtime Environment
- PdfBox JAR file
  - Download: http://pdfbox.apache.org/downloads.html
  - Minimum version: 1.2.0
  - Recommended version: >= 1.8.3
- PHP needs permissions for shell execution

## Install
To install with composer:

```sh
composer require sgh/pdfbox
```

## Basic Usage
```php
use SGH\PdfBox

//$pdf = GENERATED_PDF;
$converter = new PdfBox;
$converter->setPathToPdfBox('/usr/bin/pdfbox-app-1.7.0.jar');
$text = $converter->textFromPdfStream($pdf);
$html = $converter->htmlFromPdfStream($pdf);
$dom  = $converter->domFromPdfStream($pdf);
```

If the source PDF is a file, use `xxxFromPdfFile()` instead `xxxFromPdfStream()` with the source path as parameter.

If you want to save the converted output to a file, specify the destination path as second parameter of the `xxxFromPdfxxx()` methods.

## Advanced Usage

Convert a range of pages instead of the full document:
```php
$converter->getOptions()
    ->setStartPage(2)
	->setEndPage(5);
```

Ignore corrupt objects in the PDF:
```php
$converter->getOptions()
    ->setForce(true);
```

Sort text:
```php
$converter->getOptions()
    ->setSort(true);
```

## PHPUnit tests
To run the unit tests, change the environment variable `PDFBOX_JAR` to the full path of your PdfBox JAR file. See *phpunit.xml.dist*.
