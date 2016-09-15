<?php
namespace App;

$autoloader = spl_autoload_register(function($class){
    $file = implode('/', explode('\\', "{$class}.php"));
    if(file_exists($file)){
        require_once($file);
    } else {
        die("class not found: $class, ($file)");   
    }
});

