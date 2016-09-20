<?php

/**
 * Universal function for layouts
 * @param string $page          php page inside the root view folder
 * @param array  [$vars         = null] variables to carrie over to file
 */
function layout($page, $vars = null){
    if($vars !== null ) extract($vars);
    include('view/'.preg_replace("/\\./uimx", "/", $page).'.php');
}


require_once("app/App.php");