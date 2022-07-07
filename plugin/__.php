<?php

use PhpMyAdmin\MoTranslator\Loader;

function __($in, $print=true)
{
    $loader = new Loader();
    $loader->setlocale(DEFAULT_LANGUAGE);
    $loader->textdomain('i18n');
    $loader->bindtextdomain('i18n', realpath(__DIR__.'/../locale'));
    $translator = $loader->getTranslator();
    $out=$translator->gettext($in);
    $out=htmlentities($out);
    if ($print) {
        print $out;
    } else {
        return $out;
    }
}
