<?php

/**
*   Direct Setup
*   Direct::[to, post](url, controller@method)
*/

Direct::get("/test/{id}", 'MainController@index');


Direct::get("/", 'MainController@test');


//Direct::err("404", 'MainController@error');