<?php

if (!($loader = @include __DIR__ . '/../vendor/autoload.php')) {
    die(<<<EOT
You need to install the project dependencies using Composer:
$ curl -sS https://getcomposer.org/installer | php
$ php composer.phar install --dev
$ phpunit

EOT
    );
}

$loader->add('SGH\PdfBox', __DIR__);
