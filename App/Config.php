<?php

namespace App;


class Config {
    
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
    
    
    /**
    *   Namespace for controllers
    */
    
    public static $controllers = '\App\Controllers\\';
    
    
    /**
    *   Class aliases
    */

    public static $aliases = [
        
        // Classes
        '\App\Config' => 'Config',
        
        '\App\Database\Database' => 'DB',
        '\App\Database\Row' => 'Row',
        '\App\Database\Migrations' => 'Migrations',
        '\App\Controllers\Controller' => 'BaseController',
        '\App\Api\Populate' => 'populate',
        '\App\Controllers\ErrorHandling' => 'ErrorHandling',
       
        // Routing
        '\App\View' => 'View',
        '\App\Routing\Direct' => 'Direct',
        '\App\Routing\Route' => 'Route',
        '\App\Render' => 'Render',
        
        // API
        '\App\Api\Taxon' => 'Taxon',
        '\App\Api\Csv' => 'Csv',
        '\App\Api\Maps' => 'Maps',
        
        //Interfaces
        //'\App\Interfaces\Controller' => 'Controller',
    ];
    
}