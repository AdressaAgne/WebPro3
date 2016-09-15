<?php

function layout($page, $vars = null){
    if($vars !== null ) extract($vars);
    include('view/'.preg_replace("/\\./uimx", "/", $page).'.php');
}

require_once("app/App.php");