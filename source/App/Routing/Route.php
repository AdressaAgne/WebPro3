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
                return ['error' => 'post highjack detected'];
            } 
            
            switch($_POST['_method']) {
                case 'PUT':
                    return self::method('put', $route);
                break;

                case 'UPDATE':
                    return self::method('update', $route);
                break;

                case 'DELETE':
                    return self::method('delete', $route);
                break;
              
                case 'POST':
                    return self::method('post', $route);
                break;

                default:
                    if(array_key_exists('405', self::$routes['error'])){
                        return self::$routes['error']['405'];
                    } else {
                        return ['error' => '405 Method '.$_POST['_method'].' not allowed'];
                    }
                break;
            }
        } else {
            if(array_key_exists($route, self::$routes['get'])){
                return self::$routes['get'][$route];
            } else {
                return array_key_exists('404', self::$routes['error']) ? self::$routes['error']['404'] : ['error' => '404: Please set up a 404 page'];
            }
        }
    }
    
    public static function method($method, $route){
        if(array_key_exists($route, self::$routes[$method])){
            return self::$routes[$method][$route];
        } else {
            return ['error' => 'No route to '.$route.' with _method '.$method];
        }
    }
    
    public static function error($error){
        
        return ['error' => $error];
        
    }
    
    public static function lists(){
        return self::$routes;
    }
}