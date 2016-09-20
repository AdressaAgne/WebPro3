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
        '\App\Database\Database' => 'DB',
        '\App\View' => 'View',
        '\App\Routing\Direct' => 'Direct',
        '\App\Routing\Route' => 'Route',
        '\App\Api\Taxon' => 'Taxon',
        '\App\Api\Csv' => 'Csv',
        '\App\Api\Maps' => 'Maps',
        '\App\Config' => 'Config',
        '\App\Controllers\ErrorHandling' => 'ErrorHandling',
    ];
    
}