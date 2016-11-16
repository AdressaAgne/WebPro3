<?php

namespace App\Api;

use \App\Database\Database as DB;
use \App\Api\Csv as csv;

class Populate {
    
    /**
     * populate database with taxons/species from Taxon CSV files
     */
    public static function run($fast = true){
        $db = new DB();
        $csv = new Csv();
        
        // Clear the table before populating with new data;
        $db->clearTable('blacklist');
        $data = [];
        foreach($csv->fetchAll() as $key => $value){
           $data[] = [
               'scientificName' => $value['Vitenskapelig navn'],
               'navn'           => $value['Norsk navn'],
               'svalbard'       => ($value['Norge/Svalbard'] == 'N' ? false : true),
               'risiko'         => $value['Risiko'],
               'taxonID'        => $value['TaxonId'],
               'image'         =>   1,
               'family'        =>  ($fast == true ? 'groupname' : Taxon::getGroupName(Taxon::byID($value['TaxonId']))),
           ];
        }
        
        return $db->insert($data, 'blacklist');
        
    }
    
    
}