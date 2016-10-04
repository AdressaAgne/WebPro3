<?php

/**
*   Direct Setup
*   Direct::[to, post](url, controller@method)
*/

Direct::get("/test/{id}", 'MainController@index');
Direct::get("/agne/{hei}", 'MainController@ball');


Direct::get("/login", 'LoginController@index');

Direct::post("/register", 'LoginController@reg');
Direct::post("/login", 'LoginController@post');

Direct::get("/migrate", 'MigrateController@migrate');

Direct::get("/nearby", 'NearByController@index');
Direct::get("/nearby_api/{lat}/{lng}/{dist}", 'NearByController@api');


Direct::get("/", 'MainController@test');
Direct::get("/groups", 'NearByController@groups');



//Direct::err("404", 'MainController@error');