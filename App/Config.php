<?php

namespace App;


class Config {
    
    
    public static $debug_mode = true;
    
    
    /**
    *   Database Connection
    */
    
    public static $host = 'localhost';
    public static $database = 'blacklistfood';
    public static $username = 'root';
    public static $password = 'root';
    
    
    public static $cookie_time = 86400 * 30;
    
    /**
    *   API types
    */
    
    public static $csv = [
        // Høy Risiko
        'hi' => 'assets/data/hi.csv', 
        
        // Svert Høy Risiko
        'se' => 'assets/data/se.csv',  
    ];
    
    public static $api_url = [
        'taxon' => "http://data.artsdatabanken.no/Api/Taxon/",
        'maps'  => "http://artskart2.artsdatabanken.no/api/",
    ];
    public static $api_types = [
      'scientificName' => 'ScientificName?ScientificName=',
      'scientificNameSuggest' => 'ScientificName/Suggest?ScientificName=',
    ];
    
    
    public static $userFiles = "assets/userFiles/";
    
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
        
        // Database
        '\App\Database\Database' => 'DB',
        '\App\Database\Row' => 'Row',
        '\App\Database\Migrations' => 'Migrations',

        // Routing
        '\App\View' => 'View',
        '\App\Routing\Direct' => 'Direct',
        '\App\Routing\Route' => 'Route',
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