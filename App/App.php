<?php
namespace App;

use \App\Routing\Direct as Direct;
use \App\Routing\Route as Route;
use \App\Config as Config;
use \App\Controllers\ErrorHandling as ErrorHandling;

// Start a session if it does not exist
if(!isset($_SESSION)){
    session_start();
}

/**
 * SPL autoloader, so we dont need to include files everywhere
 * @author Agne *degaard
 * @param function function($class)
 */
spl_autoload_register(function($class){
    $file = implode('/', explode('\\', "{$class}.php"));
    if(file_exists($file)){
        require_once($file);
    } else { 
        ErrorHandling::fire("class not found:", "", [  
            "class: $class", 
            "file: $file",
        ]);
    }
});

// Setting up aliases
foreach(Config::$aliases as $key => $value){
    class_alias($key, $value);
}

// Adding routing
require_once('App/Routing/RouteSetup.php');

// Start Route Handling
class App {
    private $url;
    
    private function get_path(){
        return "/".preg_replace("/(.*)m=(.*)/uimx", "$2", $_SERVER['QUERY_STRING']);
    }
    
    private function get_vars($path){
        $regex = $this->regexSlash($this->get_current_page());
        $str = preg_replace("/$regex/uimx", '', $this->get_path());
        return explode("/", trim($str, "/"));   
    }
    
    protected function regexSlash($str){
        return preg_replace('/\//uimx', '\\\\/', $str);
    }
    
    protected function get_page(){
        $url = $this->get_path();
        $list = [];
        // Minify this stuff
        foreach(Route::lists() as $type => $types){
            foreach($types as $key => $value){
               if(preg_match("/".$this->regexSlash($key)."/i", $url)){
                   $list[] = $key;
               }
            }
        }
        $lengths = array_map('strlen', $list);
        $maxLength = max($lengths);
        $index = array_search($maxLength, $lengths);
        return ['page' => $list[$index], 'key' => count(explode($list[$index], '/'))];
    }
    
    protected function get_current_page(){
        return $this->get_page()['page'];
    }
    protected function get_page_offset(){
        return $this->get_page()['key'];
    }
    
    public function __construct(){
        $this->url = $this->get_current_page();
        $route = Direct::getCurrentRoute($this->url);
        
        if(array_key_exists("error", $route)){
            ErrorHandling::fire("View Does not Exist: " . $this->url,
                                "Please set up a route to 404",
                                ['App/Routing/RouteSetup.php', 
                                 'Direct::err("404", "Controller@method");'
                                ]);
        }
        
        if(!empty($route['vars'])){
            $vars = $this->get_vars($this->url);
            
            foreach($route['vars'] as $key => $value){
                if(isset($vars[$key])){
                    $_GET[$value] = $vars[$key];
                }
            }
        }
        
        $view = explode('@', $route['callback']);
        if(!($obj = @call_user_func([new $view[0], $view[1]], array_merge($_GET, $_POST)))){
            ErrorHandling::fire("Error", $view[0]."@".$view[1]. " could not execute");
        }
        
        if(gettype($obj) !== 'string'){
            @header('Content-type: application/json');
            echo json_encode($obj, JSON_UNESCAPED_UNICODE);
            return;
        } else {
            // Echo out the rendered code
            echo $obj;
        }
    }   
}

new App();