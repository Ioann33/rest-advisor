<?php
spl_autoload_register(function ($class){
    $class = str_replace('\\',  DIRECTORY_SEPARATOR, $class);
    $classPath = 'app'.DIRECTORY_SEPARATOR.$class.'.php';
    if (file_exists($classPath)){
        include_once $classPath;
        return true;
    }
    return false;
});