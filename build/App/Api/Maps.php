<?php

namespace App\Api;

use App\Api\Api as Api;
use App\Config as Config;

class Maps{
    
    //http://artskart2.artsdatabanken.no/api/
    
    /**
     * get latlong from artsdatabaneks artsopservasjoners api
     * @param  integer $taxonID taxon/specis id
     * @return array
     */
    public static function getLatLngList($taxonID){
        
        $latLngList = Api::fetchData('observations/list?pageIndex=0&pageSize=300&Taxons='.$taxonID, 'maps');
        $smallList = [];
        foreach($latLngList->Observations as $key => $value){
            $smallList[] = [
                'lng' => $value->Longitude,
                'lat' => $value->Latitude,
                'locality' => $value->Locality,
                'municipality' => $value->Municipality,
                'county' => $value->County,
                'taxonID' => $value->TaxonId,
            ];
        }
        
        return $smallList;
        
    }
    
}