<?php

/**
*   Direct Setup
*   Direct::[to, post](url, controller@method)
*/

Direct::get("/", 'MainController@test');

Direct::get("/login", 'LoginController@index');
Direct::post("/login", 'LoginController@post');

Direct::post("/register", 'LoginController@reg');

Direct::get("/nearby", 'NearByController@index');
Direct::get("/nearby_api/{lat}/{lng}/{dist}", 'NearByController@api');


Direct::get("/route", 'ErrorHandling@route');



//Direct::err("404", 'MainController@error');