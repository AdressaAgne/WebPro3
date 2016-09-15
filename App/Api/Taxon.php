<?php

//Artene som er på svartelista har enten
//kategori 
//Svært høy risiko (SE)
//høy risiko (HI). 
//Det er 113 arter i kategori svært høy risiko og 134 i høy risiko

namespace App\Api;

use App\Config;

class Taxon {
    
    public static function fetchData($str){
        $data = file_get_contents(Config::$api_url.$str);
        return json_decode($data);
    }
    
    public static function byID($id){
       return self::fetchData($id);
    }
    
    ///Vulpes%20lagopus
    public function scientificName($name){
       return $this->fetchData(Config::$api_types['scientificName'].$name);
    }
    
    //Suggest a name by string, search
    public function scientificNameSuggest($str){
       return $this->fetchData(Config::$api_types['scientificNameSuggest'].$str);
    }

}

