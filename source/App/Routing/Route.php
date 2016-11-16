<?php
namespace App\Routing;

use Config;

class Route {
    
    public static $routes = [
        'get'       => [],
        'post'      => [],
        'update'    => [],
        'put'       => [],
        'delete'    => [],
        'error'     => [],
    ];
    
    /**
     * Store all Directs in a array
     * @param  object $route Direct
     * @return string URI
     */
    public static function getCurrentRoute($route){
        
        /**
        *   Change to switc case, for put, delete and update editions.
        */
        
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            //CSRF token
            if($_POST['_token'] != $_SESSION['_token']){
               return self::$error('401');
            } 

            switch(strtoupper($_POST['_method'])) {
                    
                case 'PUT':
                    return self::method('put', $route);
                break;

                case 'UPDATE':
                    return $_POST;
                    return self::method('update', $route);
                break;

                case 'DELETE':
                    return self::method('delete', $route);
                break;
              
                case 'POST':
                    return self::method('post', $route);
                break;

                default:
                    return self::error('405');
                break;
            }
        } else {
            if(array_key_exists($route, self::$routes['get'])){
                return self::$routes['get'][$route];
            } else {
                return self::error('404');
            }
        }
    }
    
    public static function method($method, $route){
        if(array_key_exists($route, self::$routes[$method])){
            return self::$routes[$method][$route];
        } else {
            return self::error('404');
        }
    }
    
    public static function error($error){
        
        return array_key_exists($error, self::$routes['error']) ? self::$routes['error'][$error] : ['error' => "$error: Please set up a $error page"];
        
    }
    
    public static function lists(){
        return self::$routes;
    }
}