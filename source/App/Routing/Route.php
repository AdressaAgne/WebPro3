<?php
namespace App\Routing;

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
                return array_key_exists($route, self::$routes['get']) ? self::$routes['get'][$route] : ['error' => 'no route', 'callback' => 'no callback'];
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