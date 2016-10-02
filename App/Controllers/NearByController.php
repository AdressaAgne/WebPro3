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
        $dist = isset($_GET['dist']) ? $_GET['dist'] : 25;
        $_GET['lat'] = isset($_GET['lat']) ? $_GET['lat'] : '59.342836';
        $_GET['lng'] = isset($_GET['lng']) ? $_GET['lng'] : '5.298503';
        
        
        $db = new DB();
        
        return $db->query('SELECT list.navn, list.scientificName, kart.taxonID, kart.lat, kart.lng, 
          ( 6371 * acos( cos( radians(kart.lat) ) * cos( radians( :lat ) ) * cos( radians( :lng ) - radians(kart.lng) ) + sin( radians(kart.lat) ) *
          sin( radians( :lat ) ) ) ) 
          AS distance 
          FROM artskart as kart 
          JOIN blacklist AS list
          ON list.taxonID = kart.taxonID
          HAVING distance < :dist ORDER BY distance', [
              'lat' => $_GET['lat'],
              'lng' => $_GET['lng'],
              'dist' => $dist,
          ])->fetchAll();
    }
    
    
}