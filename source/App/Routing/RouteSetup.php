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
Direct::post('/recipie/item/favorite', 'RecipieController@favorite')->Auth();

Direct::get("/species", 'SpeciesController@index');
Direct::post("/species/sorting", 'SpeciesController@sorting');
Direct::get("/taxon/item/{taxon}", 'SpeciesController@item');
Direct::get("/api/taxon/{taxon}", 'NearByController@get_location_by_taxon');
Direct::get("/nearby", 'NearByController@index');
Direct::get("/about", 'MainController@about');

Direct::get("/profile", "ProfileController@index")->Auth();
Direct::get("/profile/update", "ProfileController@profieEdit")->Auth();
Direct::get("/farliggodtapp", "MainController@app");
Direct::update("/profile/update", "ProfileController@edit")->Auth();
Direct::get("/profile/favoritter", "ProfileController@getFavoriteRecipes")->Auth();


Direct::post("recipie/uploadimage", 'RecipieController@ajaxUpload');
Direct::post("profile/image", 'ProfileController@ajaxUpload')->auth();
Direct::get("/api/nearby/{lat}/{lng}/{dist}", 'NearByController@api');
Direct::get("/api/search/{taxon}/{dist}", 'NearByController@taxon_api');


Direct::get("/migrate", 'MigrateController@migrate');
Direct::get("/api/blacklist", 'ApiController@index');
Direct::get("/api/check", 'ApiController@check');
Direct::get("/api/images", 'ApiController@image');


Direct::get("/route", 'ErrorHandling@route')->Admin();
Direct::get("/admin", 'AdminController@index')->Admin();


Direct::err("404", 'MainController@error');
