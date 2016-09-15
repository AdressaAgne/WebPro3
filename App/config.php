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
    
    
}