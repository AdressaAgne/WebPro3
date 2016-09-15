<?php

namespace App;


class Config {
    
    public static $csv = [
        // Høy Risiko
        'hi' => 'data/hi.csv', 
        
        // Svert Høy Risiko
        'se' => 'data/se.csv',  
    ];
    
    
    public static $api_url = "http://data.artsdatabanken.no/Api/Taxon/";
    public static $api_types = [
      'scientificName' => 'Taxon/ScientificName?ScientificName=',
      'scientificNameSuggest' => 'ScientificName/Suggest?ScientificName=',
    ];
    
    
}