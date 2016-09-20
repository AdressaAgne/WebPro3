<?php
namespace App\Api;

use App\Config as Config;
use App\Api\Api as Api;

class Taxon {
    
    /**
     * fetch taxon by id
     * @param  integer $id taxon id
     * @return arra    
     */
    public static function byID($id){
       return Api::fetchData($id);
    }
    
    /**
     * get taxon groupname
     * @param  object $cls byID object
     * @return string
     */
    public static function getGroupName($cls){
        if(gettype($cls) !== "object") return null; 
        return $cls->scientificNames[0]->dynamicProperties[0]->Value;
    }
    
    /**
     * get who first wrote down the taxon
     * @param  object $cls byID object
     * @return string
     */
    public static function getScientificNameAuthorship($cls){
        if(gettype($cls) !== "object") return null;
        return $cls->scientificNames[0]->scientificNameAuthorship;
    }
    
    /**
     * get taxon hiraky
     * @param  object $cls byID object
     * @return array
     */
    public static function getHigherClassification($cls){
        if(gettype($cls) !== "object") return null;
        $groups = [];
        foreach($cls->scientificNames[0]->higherClassification as $key => $value){
            $groups[$value->taxonRank] = $value->scientificName;
        }
       return $groups;
    }
    
    /**
     * find taxon by name
     * @param  string   $name
     * @return array 
     */
    public function scientificName($name){
       return Api::fetchData(Config::$api_types['scientificName'].$name);
    }
    
    /**
     * search taxon by string
     * @param  string   $str
     * @return array  array of possible taxons
     */
    public function scientificNameSuggest($str){
       return Api::fetchData(Config::$api_types['scientificNameSuggest'].$str);
    }

}

