<?php


namespace App;

use \App\Routing\Direct as Direct;

$autoloader = spl_autoload_register(function($class){
    $file = implode('/', explode('\\', "{$class}.php"));
    if(file_exists($file)){
        require_once($file);
    } else {
        //die("class not found: $class, ($file) in <b>" . __FILE__ . "</b>");   
    }
});

// Adding routing
require_once('App/Routing/RouteSetup.php');


// Start Route Handling
class App {
    
    private $url;
    
    public function __construct(){
        $this->url = $_SERVER['REQUEST_URI'];
        $route = Direct::getCurrentRoute($this->url);
        
      
        
        if(gettype($route) === 'array'){
            print_r($route);
            return;
        }
        
        $view = explode('@', $route);
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
