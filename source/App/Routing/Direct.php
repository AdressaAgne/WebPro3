<?php

namespace App\Routing;

use Config;

class Direct extends Route{
    
    public function __construct($route, $callback, $type, $get = null){
        parent::$routes[$type][$route] = [
                                    'callback' => Config::$controllers.$callback,
                                    'vars' => $get, 
                                ];
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
     * @param  string  $a URI
     * @param  callback $b 
     * @return object   Direct Object
     * and so on...
     */
    public static function get($a, $b){
        $get = explode(",", preg_replace("/(.*)\/(\\{(.*)\\})/uiUmx", "$3,", $a));
        array_pop($get);
        return new Direct("/".trim(preg_replace("/(.*)\/(\\{(.*)\\})/uiUmx", "$1", $a), "/"), $b, 'get', $get);
    }
    
    //<input type="hidden" name="_method" value="DELETE">
    public static function delete($a, $b){
        return new Direct($a, $b, 'delete');
    }
    
    //<input type="hidden" name="_method" value="PUT">
    public static function put($a, $b){
        return new Direct($a, $b, 'put');
    }
    
    public static function update($a, $b){
        return new Direct($a, $b, 'update');
    }
   
    public static function post($a, $b){
        return new Direct($a, $b, 'post');
    }
    
    public static function err($a, $b){
        return new Direct($a, $b, 'error');
    }
    public static function something($a, $b){
        self::get($a, "$b@index");
        self::post($a, "$b@post");
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