<?php

require 'cfg.php';
if (MAINTENANCE_MODE) {
    die('maintenance mode 🤖');
}
$str=segment(1);
if ($str=='/') {
    $str='home';
}
$str=ucfirst($str);
$filename=__DIR__.'/controller/'.$str.'.php';
if (ctype_alpha($str) and file_exists($filename)) {
    require $filename;
    $obj=new $str();
    $str=$_SERVER['REQUEST_METHOD'];
    if ($str=='POST') {
        $str='post';
    } else {
        $str='get';
    }
    if (method_exists($obj, $str)) {
        $obj->$str();
    }
}
