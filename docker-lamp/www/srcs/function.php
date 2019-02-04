<?php

function debug($var){
    echo '<pre>'.print_r($var, true).'</pre>';
}

function str_random($length){
    $alphabet= "0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
    return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
}