<?php
namespace App\Controllers;

use View, Direct, Route; // Routing
use Taxon, Csv, Maps; // APIs
use DB, BaseController, Migrations;
use App\Api\Populate as pop;

/**
 * making a view with/without variables to render
 * @return object View
 */
class NearByController extends BaseController {
    // run on get /
    
    public function index(){
        
        return View::make('nearby');
    }
    
    /**
     * Calculates the great-circle distance between two points, with
     * the Haversine formula.
     * @param float $latitudeFrom  Latitude of start point in [deg decimal]
     * @param float $longitudeFrom Longitude of start point in [deg decimal]
     * @param float $latitudeTo    Latitude of target point in [deg decimal]
     * @param float $longitudeTo   Longitude of target point in [deg decimal]
     * @param float $earthRadius   Mean earth radius in [m]
     * @return float Distance between points in [m] (same as earthRadius)
     */
    function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000){
      // convert from degrees to radians
      $latFrom = deg2rad($latitudeFrom);
      $lonFrom = deg2rad($longitudeFrom);
      $latTo = deg2rad($latitudeTo);
      $lonTo = deg2rad($longitudeTo);

      $latDelta = $latTo - $latFrom;
      $lonDelta = $lonTo - $lonFrom;

      $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
        cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
      return $angle * $earthRadius;
    }
    
    
    public function fetchAPIdata(){
        // this will run for like 30min...
        
        $csv = new CSV();
        $db = new DB();
        //return Maps::getLatLngList(84141);
        
        foreach($csv->fetchAll() as $key => $value){
            foreach(Maps::getLatLngList($value['TaxonId']) as $key => $value){
                $db->insert([
                    'taxonID' => $value['taxonID'],
                    'lat' => $value['lat'],
                    'lng' => $value['lng'],
                    'distance' => $value['lng'],
                ], 'artskart');
            }
        }
        
    }
    
    public function api(){
        if(empty($_POST['lat'])) $_POST['lat'] = '59.342836';
        if(empty($_POST['lng'])) $_POST['lng'] = '5.298503';
        $db = new DB();
        
        return $db->query('SELECT taxonID, lat, lng, ( 6371 * acos( cos( radians(lat) ) * cos( radians( :lat ) ) * cos( radians( :lng ) - radians(lng) ) + sin( radians(lat) ) * sin( radians( :lat ) ) ) ) AS distance FROM artskart HAVING distance < 25 ORDER BY distance', [
            'lat' => $_POST['lat'],
            'lng' => $_POST['lng'],
        ])->fetchAll();
        //{"lng":"5.298503","lat":"59.342836","locality":"Breidbukta, Hus\u00f8y","municipality":"Karm\u00f8y","county":"Rogaland","taxonID":84141}
        return [    
            [
                'lat' => 59.342836,
                'lng' => 5.298503,
                'taxonID' => 84141,
                'name'    => 'stillehavsøsters',
                'locality' => 'hei',
                'municipality' => 'sted',
                'county'    => 'ball',
            ],[
                'lat' => 59.342836,
                'lng' => 5.298503,
                'taxonID' => 84141,
                'name'    => 'stillehavsøsters',
                'locality' => 'hei',
                'municipality' => 'sted',
                'county'    => 'ball',
            ],[
                'lat' => 59.342836,
                'lng' => 5.298503,
                'taxonID' => 84141,
                'name'    => 'stillehavsøsters',
                'locality' => 'hei',
                'municipality' => 'sted',
                'county'    => 'ball',
            ],
            
        ];
        
        
    }
    
    
}