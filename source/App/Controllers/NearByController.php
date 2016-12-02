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
    
    
    public function test1(){
        return ['test' => 1];
    }
    
    public function test2($p){
        return ['test' => 2, 'p' => $p];
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
    
    public function testapi(){
        //fetch all blacklisted species from artsobservasjoner
        
        $csv = new Csv();
        $taxons = ['59373',
                  '3413',
                  '3457',
                  '84141',
                  '61212',
                  '31106',
                  '60303',
                  '31227',
                  '26171',
                  '14365',
                  '60308',
                  '63574',
                  '62346',
                  '38890'
                  ];

        $taxons = implode(',', $taxons);
        $pageSize = 1000;

        $total = json_decode(file_get_contents('http://artskart2.artsdatabanken.no/Api/Observations/list?pageIndex=0&pageSize=1&Taxons='.$taxons))->TotalPages;

        //$this->clearTable('artskart');
        
        $urls = [];
       
        
        for($i = 0; $i < $total; $i++){
            $data = [];
            $url = 'http://artskart2.artsdatabanken.no/Api/Observations/list?pageIndex='.$i.'&pageSize='.$pageSize.'&Taxons='.$taxons;
            $a = json_decode(file_get_contents($url));
            $urls[] = $url;
           
            foreach($a->Observations as $key => $value){
                $data[] = [
                    'taxonID' => $value->TaxonId,
                    'lng' => $value->Longitude,
                    'lat' => $value->Latitude,
                ];
            }
            
            $this->insert($data, 'artskart');
            
        }
        
        return $a;
    }
    
    public function placesApi(){
        $file = "assets/data/stedsnavn.json";
        $json = json_decode(file_get_contents($file));
        $data = [];
        foreach($json as $key => $value){
            $data[] = [
                'name' => $value->properties->for_snavn,
                'lat' => $value->geometry->coordinates[0],
                'lng' => $value->geometry->coordinates[1],
            ];  
        }

        return $this->insert($data, 'places');
    }
    
    public function get_location_by_taxon($p){
        
        return $this->query("SELECT * FROM artskart WHERE taxonID = :taxon LIMIT 500",['taxon' => $p['taxon']])->fetchAll();
      
    }
    
    public function taxon_api($p){
        return $this->query('SELECT navn, taxonId FROM blacklist WHERE navn LIKE :name', ['name' => "%".$p['taxon']."%"])->fetchAll();
    }
    
    public function api($p){
        $p['dist'] = isset($p['dist']) ? $p['dist'] : 25;
        $p['lat'] = isset($p['lat']) ? $p['lat'] : '59.342836';
        $p['lng'] = isset($p['lng']) ? $p['lng'] : '5.298503';
        
        
        // Haversine formula
        $query = $this->query('SELECT list.navn, list.scientificName, kart.taxonID, kart.lat, kart.lng, 
          ( 6371 * acos( cos( radians(kart.lat) ) * cos( radians( :lat ) ) * cos( radians( :lng ) - radians(kart.lng) ) + sin( radians(kart.lat) ) *
          sin( radians( :lat ) ) ) ) 
          AS distance 
          FROM artskart as kart 
          JOIN blacklist AS list
          ON list.taxonID = kart.taxonID
          HAVING distance < :dist ORDER BY distance', [
              'lat' => $p['lat'],
              'lng' => $p['lng'],
              'dist' => $p['dist'],
          ])->fetchAll();
        
        return empty($query) ? ['data' => null] : $query;
    }
    
    public function groups(){
        
        $data = $this->query("SELECT * FROM blacklist")->fetch();
        return Taxon::byID($data['taxonID']);
    }
    
}