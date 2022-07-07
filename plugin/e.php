<?php

function e($str, $print=true)
{
    $str=htmlentities($str);
    if ($print) {
        print $str;
    } else {
        return $str;
    }
}
