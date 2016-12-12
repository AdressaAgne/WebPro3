<?php
namespace App\Routing;

use Config, DB;

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
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            //CSRF token
            if($_POST['_token'] != $_SESSION['_token']){
               return self::error('401');
            } 

            switch(strtoupper($_POST['_method'])) {
                    
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
                    return self::error('405');
                break;
            }
        } else {
            return self::method('get', $route);
        }
    }
    
    /**
     * Return the right class and method to call on different HTTP Requests.
     * @author Agne *degaard
     * @param  string $method Post,Put,Delte, etc
     * @param  str    $route  url
     * @return array contains Class and Method to call,
     */
    public static function method($method, $route){
        /**
        *   todo: Auth for Admin and Mod.
        */
        if(array_key_exists($route, self::$routes[$method])){
            $key = self::$routes[$method][$route];
            
            if(isset($key['middleware']['auth'])){
                if(isset($key['middleware']['callback'])){
                    call_user_func($key['middleware']['callback']);   
                }
                if(!isset($_SESSION['uuid'])){
                    return self::error('403');   
                }
                $db = new DB();
                
                $user = $db::select(['*'], 'users', ['id' => $_SESSION['uuid']], 'user')->fetch();

                if($user->getRank() > $key['middleware']['auth']['grade']){
                     return self::error('403');
                }
                
                
                
                
            }
            return self::$routes[$method][$route];
        } else {
            return self::error('404');
        }
    }
    
    public static function error($error){
        
        return array_key_exists($error, self::$routes['error']) ? self::$routes['error'][$error] : ['error' => "$error: Please set up a $error page"];
        
    }
    
    /**
     * Lists all the routs.
     * @author Agne *degaard
     * @return array
     */
    public static function lists(){
        return self::$routes;
    }
}