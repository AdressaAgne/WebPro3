<?php

namespace App;


class Config {


    public static $debug_mode = false;


    /**
    *   Database Connection
    */

    public static $host = 'localhost';
    public static $database = 'blacklistfood';
    public static $username = 'root';
    public static $password = 'root';

    public static $form_token = 'jlhkgfdlkshdjkskdfskjdhf';


    public static $cookie_time = 86400 * 30;
    public static $cache_time = 60 * 10;
    public static $cache_folder = 'assets/cache/';

    /**
    *   API types
    */

    public static $csv = [
        // Høy Risiko
        'hi' => 'assets/data/hi.csv',

        // Svert Høy Risiko
        'se' => 'assets/data/se.csv',
    ];

    public static $api_url    = [
        'taxon' => "http://data.artsdatabanken.no/Api/Taxon/",
        'maps'  => "http://artskart2.artsdatabanken.no/api/",
    ];
    public static $api_types  = [
      'scientificName'        => 'ScientificName?ScientificName=',
      'scientificNameSuggest' => 'ScientificName/Suggest?ScientificName=',
    ];


    public static $files      = [
      "original" => "/assets/userFiles/original/",
      "compressed" => "/assets/userFiles/compressed/",
      "compressedSize" => 600,
      "compressedSize2" => 1000,
      ];

    /**
    *   Namespace for controllers
    */

    public static $controllers = '\App\Controllers\\';


    /**
    *   Class aliases
    */

    public static $aliases = [

        // Config
        '\App\Config' => 'Config',

        // Modules
        '\App\Modules\Recipie' => 'Recipie',
        '\App\Modules\User' => 'User',
        '\App\Modules\Comment' => 'Comment',
        '\App\Modules\Ingredient' => 'Ingredient',

        // Database
        '\App\Database\Database' => 'DB',
        '\App\Database\Row' => 'Row',
        '\App\Database\Migrations' => 'Migrations',
        '\App\Auth\Account' => 'Account',

        // Routing
        '\App\View' => 'View',
        '\App\Routing\Direct' => 'Direct',
        '\App\Routing\Route' => 'Route',
        '\App\Routing\RouteHandler' => 'RouteHandler',
        '\App\Render' => 'Render',

        // API
        '\App\Api\Taxon' => 'Taxon',
        '\App\Api\Csv' => 'Csv',
        '\App\Api\Maps' => 'Maps',
        '\App\Api\Populate' => 'populate',

        // Helpres

        '\App\Helpers\Mail' => 'Mail',
        '\App\Helpers\Units' => 'Units',
        '\App\Helpers\Uploader' => 'Uploader',
        '\App\Helpers\Compressor' => 'Compressor',
        '\App\Controllers\ErrorHandling' => 'ErrorHandling',
        '\App\Controllers\Controller' => 'BaseController',

    ];

}
