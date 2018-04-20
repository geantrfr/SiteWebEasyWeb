<?php

function __autoload($name){
    $dir = 'Class/'.$name.'.php';
    if(file_exists($dir)){
        require_once $dir;
    }else{
        if(file_exists('Class/model.txt')){
            $content = file_get_contents('Class/model.txt');
            $content = str_replace('{{className}}', ucfirst($name), $content);
            $file = fopen($dir, 'w');
            fputs($file, $content);
            fclose($file);
            require_once $dir;
        }
    }
}