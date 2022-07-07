<?php

namespace app\lib;

use PhpMyAdmin\MoTranslator\Cache\InMemoryCache;
use PhpMyAdmin\MoTranslator\MoParser;
use PhpMyAdmin\MoTranslator\Translator;
use app\lib\Utils;

class I18n
{
    public $langs;
    public $cfg;
    public function __construct($languagesStr)
    {
        $this->langs=explode(',', trim($languagesStr));
    }
    public function converterMoParaJson()
    {
        print 'gerando arquivo i18n.json...'.PHP_EOL;
        $translations=[];
        $root=realpath(__DIR__.'/../');
        foreach ($this->langs as $lang) {
            $filename=$root.'/locale/'.$lang.'/LC_MESSAGES/i18n.mo';
            $cache = new InMemoryCache(new MoParser($filename));
            $translator = new Translator($cache);
            $translations[$lang]=$translator->getTranslations();
            unset($translations[$lang]['']);
        }
        $str=json_encode($translations, JSON_PRETTY_PRINT);
        $filename=$root.'/locale/i18n.json';
        file_put_contents($filename, $str);
    }
    public function criarTraduções()
    {
        system('clear');
        $root=realpath(__DIR__.'/../');
        foreach ($this->langs as $langCode) {
            $folderStr=$root.'/locale';
            if (!file_exists($folderStr)) {
                mkdir($folderStr, 0777, true);
            }
            $folderStr.='/'.$langCode;
            if (!file_exists($folderStr)) {
                mkdir($folderStr, 0777, true);
            }
            $folderStr.='/LC_MESSAGES';
            if (!file_exists($folderStr)) {
                mkdir($folderStr, 0777, true);
            }
            $filename=$root.'/locale/pt/LC_MESSAGES/i18n.po';
            $prefixo='gerando';
            if (file_exists($filename)) {
                $prefixo='atualizando';
            }
            print $prefixo.' tradução para '.$langCode.'...'.PHP_EOL;
            $cmdStr='xgettext --sort-output ';
            if (file_exists($filename)) {
                $cmdStr.='--join-existing ';//atualizar
            }
            $cmdStr.='-o '.$root.'/locale/'.$langCode.'/LC_MESSAGES/i18n.po '.$root.'/view/*.php ';
            $cmdStr.=$root.'/view/*/*.php ';
            $cmdStr.=' --from-code=UTF-8 --keyword=__ --language=PHP';
            system($cmdStr);
        }
    }
}
require realpath(__DIR__.'/../cfg.php');

$i18n=new I18n(SITE_LANGUAGES);
$i18n->criarTraduções();
exit('pronto!'.PHP_EOL);
