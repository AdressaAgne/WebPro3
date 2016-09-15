<?php
use App\Routing\Direct as Direct;
/**
*   Direct Setup
*   Direct::[to, post](url, controller@method)
*/
Direct::get("/", 'MainController@index');
