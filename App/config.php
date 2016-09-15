<?php

namespace App;


class Config {
    
    public static $host = 'localhost';
    public static $database = 'blacklistfood';
    public static $username = 'root';
    public static $password = 'root';
    
    public static $csv = [
        // Høy Risiko
        'hi' => 'assets/data/hi.csv', 
        
        // Svert Høy Risiko
        'se' => 'assets/data/se.csv',  
    ];
    
    
    public static $api_url = "http://data.artsdatabanken.no/Api/Taxon/";
    public static $api_types = [
      'scientificName' => 'ScientificName?ScientificName=',
      'scientificNameSuggest' => 'ScientificName/Suggest?ScientificName=',
    ];
    
    
}