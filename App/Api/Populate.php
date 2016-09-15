<?php

namespace App\Api;

use \App\Database\Database as DB;
use \App\Api\Csv as csv;

class Populate {
    
    
    public static function run(){
        $db = new DB();
        $csv = new Csv();
        
        // Clear the table before populating with new data;
        $db->clearTable('blacklist');
        
        foreach($csv->fetchAll() as $key => $value){
           $db->insert([
               'scientificName' => $value['Vitenskapelig navn'],
               'navn'           => $value['Norsk navn'],
               'svalbard'       => ($value['Norge/Svalbard'] == 'N' ? false : true),
               'risiko'         => $value['Risiko'],
               'taxonID'        => $value['TaxonId'],
           ], 'blacklist');
        }
        
    }
    
    
}