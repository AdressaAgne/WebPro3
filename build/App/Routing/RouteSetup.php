<?php

/**
*   Direct Setup
*   Direct::[to, post](url, controller@method)
*/

Direct::get("/", 'MainController@test');
Direct::get("/test", 'NearByController@testapi');

Direct::get("/login", 'LoginController@index');
Direct::post("/login", 'LoginController@post');

Direct::post("/register", 'LoginController@reg');

Direct::get("/recipie/item/{id}", 'MainController@recipie');
Direct::get("/recipie/insert", 'RecipieController@index');
Direct::post("/recipie/insert", 'RecipieController@put');
Direct::post("recipie/uploadimage", 'RecipieController@upload');
Direct::get("/recipie", 'MainController@recipies');
Direct::get("/species", 'MainController@species');
Direct::get("/taxon/item/{taxon}", 'MainController@specie');
Direct::get("/api/taxon/{taxon}", 'NearByController@get_location_by_taxon');
Direct::get("/nearby", 'NearByController@index');
Direct::get("/about", 'MainController@about');


Direct::get("/api/nearby/{lat}/{lng}/{dist}", 'NearByController@api');
Direct::get("/api/search/{taxon}/{dist}", 'NearByController@taxon_api');
//Direct::get("/m", 'MigrateController@migrate');



Direct::get("/route", 'ErrorHandling@route');



//Direct::err("404", 'MainController@error');