<?php

/**
*   Direct Setup
*   Direct::[get, post, put, update, delete](url, controller@method)->[auth(callback), admin]
*/

Direct::get("/", 'MainController@index');

Direct::get("/login", 'LoginController@index');
Direct::post("/login", 'LoginController@post');
Direct::get("/logout", 'LoginController@logout');

Direct::put("/register", 'LoginController@reg');

Direct::get("/recipie/item/{id}", 'RecipieController@recipie');
Direct::get("/recipie/insert", 'RecipieController@index')->Auth();
Direct::put("/recipie/insert", 'RecipieController@put')->Auth();
Direct::get("/recipie", 'RecipieController@recipies');
Direct::put("/recipie/comment", 'RecipieController@writecomment')->Auth();
Direct::update("/recipie/rating", 'RecipieController@rate')->Auth();
Direct::post('/recipie/sort', 'RecipieController@sorting');
Direct::post('/recipes/sorting', 'RecipieController@categorySort');
Direct::get('/edit/recipie/item/{id}', 'RecipieController@editRecipe')->Auth();
Direct::get('/recipie/item/favorite/{id}', 'RecipieController@favorite')->Auth();

Direct::get("/species", 'SpeciesController@index');
Direct::post("/species/sorting", 'SpeciesController@sorting');
Direct::get("/taxon/item/{taxon}", 'SpeciesController@item');
Direct::get("/api/taxon/{taxon}", 'NearByController@get_location_by_taxon');
Direct::get("/nearby", 'NearByController@index');
Direct::get("/about", 'MainController@about');

Direct::get("/profile", "ProfileController@index")->Auth();
Direct::get("/profile/update", "ProfileController@profieEdit")->Auth();
Direct::update("/profile/update", "ProfileController@edit")->Auth();


Direct::post("recipie/uploadimage", 'RecipieController@ajaxUpload');
Direct::post("profile/image", 'ProfileController@ajaxUpload')->auth();
Direct::get("/api/nearby/{lat}/{lng}/{dist}", 'NearByController@api');
Direct::get("/api/search/{taxon}/{dist}", 'NearByController@taxon_api');


Direct::get("/m", 'MigrateController@migrate');
Direct::get("/blacklist", 'NearByController@testapi');


Direct::get("/route", 'ErrorHandling@route')->Admin();
Direct::get("/admin", 'AdminController@index')->Admin();


Direct::err("404", 'MainController@error');
