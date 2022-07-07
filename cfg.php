<?php

require __DIR__.'/const.php';
require __DIR__.'/vendor/autoload.php';
$plugins=glob(__DIR__.'/plugin' . '/*.php');
foreach ($plugins as $plugin) {
    require $plugin;
}
showErrors(true);
