<?php

Use \App\View;

/**
 * Universal function for layouts
 * @param string $page          php page inside the root view folder
 * @param array  [$vars         = null] variables to carrie over to file
 */
function layout($page, $vars = null){
    echo View::includeFile('view/'.preg_replace("/\\./uimx", "/", $page).'.php', $vars);
}


require_once("App/App.php");