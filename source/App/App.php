<?php
namespace App;

use \App\Routing\Direct as Direct;
use \App\Routing\Route as Route;
use \App\Routing\RouteHandler as RouteHandler;
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
        ErrorHandling::fire("class not found: $class", "", [
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
class App extends RouteHandler{

    public function __construct(){

        // CSRF token - Cross-site Request Forgery
        if (!isset($_SESSION['_token'])){
            $_SESSION['_token'] = uniqid();
            Config::$form_token = $_SESSION['_token'];
        }

        $page = $this->getPageData();

        if(gettype($page) !== 'string'){
            @header('Content-type: application/json');
            echo json_encode($page, JSON_UNESCAPED_UNICODE);
            return;
        } else {
            // Echo out the rendered code
            echo $page;
        }
    }
}

new App();
