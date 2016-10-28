<?php

/**
*   Direct Setup
*   Direct::[to, post](url, controller@method)
*/

Direct::get("/", 'MainController@test');
Direct::get("/test", 'MainController@testapi');

Direct::get("/login", 'LoginController@index');
Direct::post("/login", 'LoginController@post');

Direct::post("/register", 'LoginController@reg');


Direct::get("/recipie", 'MainController@recipies');
Direct::get("/nearby", 'NearByController@index');
Direct::get("/about", 'MainController@about');


Direct::get("/api/nearby/{lat}/{lng}/{dist}", 'NearByController@api');
Direct::get("/api/search/{taxon}/{dist}", 'NearByController@taxon_api');
Direct::get("/m", 'MigrateController@migrate');



Direct::get("/route", 'ErrorHandling@route');



//Direct::err("404", 'MainController@error');