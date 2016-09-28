<?php

/**
*   Direct Setup
*   Direct::[to, post](url, controller@method)
*/

Direct::get("/test/{id}", 'MainController@index');


Direct::get("/login", 'LoginController@index');

Direct::post("/register", 'LoginController@reg');
Direct::post("/login", 'LoginController@post');

Direct::get("/migrate", 'MigrateController@migrate');


Direct::get("/", 'MainController@test');


//Direct::err("404", 'MainController@error');