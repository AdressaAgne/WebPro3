<?php

namespace App\Routing;
use \App\Routing\Route as Routes;
use \App\Config as Config;

class Direct extends Routes{
    
    public function __construct($route, $callback, $type){
        parent::$routes[$type][$route] = Config::$controllers.$callback;
    }
    
    /**
     * redirect to a page
     * @param string $page
     */
    public static function re($page){
        header("location: {$page}");
    }
    
    /**
     * Create a new Direct
     * @param  integer  $a URI
     * @param  callback $b 
     * @return object   Direct Object
     * and so on...
     */
    public static function get($a, $b){
        return new Direct($a, $b, 'get');
    }
    
    public static function delete($a, $b){
        return new Direct($a, $b, 'delete');
    }
    
    public static function update($a, $b){
        return new Direct($a, $b, 'update');
    }
   
    public static function post($a, $b){
        return new Direct($a, $b, 'post');
    }
    
    public static function ball($a, $b){
        return new Direct($a, $b, 'error');
    }
    
    
    /**
     * Gets called when a method on \App\Direct does not exist
     * @private
     * @param string $func 
     * @param string $args 
     */
    public function __call($func, $args){
        die($func."(".implode(', ', $args).") is not a method of ".__CLASS__);
    }
    
}