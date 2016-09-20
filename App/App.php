<?php


namespace App;

use \App\Routing\Direct as Direct;
use \App\Config as Config;
use \App\Controllers\ErrorHandling as ErrorHandling;

$autoloader = spl_autoload_register(function($class){
    $file = implode('/', explode('\\', "{$class}.php"));
    if(file_exists($file)){
        require_once($file);
    } else {
        die("class not found: $class, ($file) in <b>" . __FILE__ . "</b>");   
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
    
    public function __construct(){
        $url = explode("/", $_SERVER['REQUEST_URI']);
        array_shift($url);
        $this->url = "/" . $url[0];
        $route = Direct::getCurrentRoute($this->url);
       
        if(array_key_exists("error", $route)){
            ErrorHandling::index("View Does not Exist: " . $this->url,
                                 "Please set up a route to 404",
                                 [  'App/Routing/RouteSetup.php', 
                                    'Direct::err("404", "Controller@method");'
                                 ]);
        }
        
        if(!empty($route['vars']) && $route['vars'][0] !== $this->url){
            array_shift($url);
            $vars = array_combine($route['vars'], $url);
            foreach($vars as $key => $value){
                $_GET[$key] = $value;
            }
        }

        if(gettype($route['callback']) === 'array'){
            print_r($route);
            return;
        }
        
        $view = explode('@', $route['callback']);
        $obj = call_user_func([$view[0], $view[1]]);
        
        // check if code is api stuff
        if(gettype($obj) !== 'string'){
            header('Content-type: application/json');
            echo json_encode($obj, JSON_UNESCAPED_UNICODE);
            return;
        } else {
            echo $obj;
        }
    }
    
}
new App();
