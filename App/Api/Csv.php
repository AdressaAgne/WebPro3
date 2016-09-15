<?php

namespace App\Api;

use App\Config;

class Csv{
    
    public function parse($file){
        
        // Convert CSV to php array
        $array = array_map(function($str){
             return str_getcsv($str, ";");
        }, file($file)); 
        
        // Set the first row as keys
        array_walk($array, function(&$value) use ($array) {
            $value = array_combine($array[0], $value);
        });
        
        array_shift($array);
        return $array;
    }
    
    public function fetchData($type){
        return $this->parse(Config::$csv[$type]);
    }
    
    public function fetchAll(){
        return array_merge($this->fetchData('hi'), $this->fetchData('se'));
    }
    
}