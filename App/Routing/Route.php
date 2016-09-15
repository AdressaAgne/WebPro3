<?php
namespace App\Routing;

class Route {
    
    public static $routes = [
        'get'       => [],
        'post'      => [],
        'update'    => [],
        'delete'    => [],
        'error'     => [],
    ];
    
    /**
     * Store all Directs in a array
     * @param  object $route Direct
     * @return string URI
     */
    public static function getCurrentRoute($route){
        if($_SERVER['REQUEST_METHOD'] == "POST" && array_key_exists($route, self::$routes['post'])){
            return array_key_exists($route, self::$routes['post']) ? self::$routes['post'][$route] : null;
        } else {
            if(array_key_exists($route, self::$routes['get'])){
                return self::$routes['get'][$route];
            } else {
                return array_key_exists('404', self::$routes['error']) ? self::$routes['error']['404'] : self::error();
            }
        } 
    }
    
    public static function error(){
        
        return ['error' => '404'];
        
    }
    
    public static function lists(){
        return $routes;
    }
}