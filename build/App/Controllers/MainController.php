<?php
namespace App\Controllers;

use View, Direct, Route; // Routing
use Taxon, Csv, Maps; // APIs
use BaseController, Migrations;
use App\Api\Populate as pop;

/**
 * making a view with/without variables to render
 * @return object View
 */
class MainController extends BaseController {
    
    public function test(){

        
        return View::make('index', [
            'food' => ['fisk', 'laks', 'mat', 'ball', 'mia', 'test3']
        ]);
    }
    
    public function testapi(){
        //fetch all blacklisted species from artsobservasjoner
        
        $csv = new Csv();
        $taxons = [];
        foreach($csv->fetchAll() as $key => $value){
            $taxons[] = $value['TaxonId'];
        }
        $taxons = implode(',', $taxons);
        $pageSize = 1000;
        
        $url = 'http://artskart2.artsdatabanken.no/Api/Observations/list?pageIndex=0&pageSize=1&Taxons='.$taxons;
        $s = json_decode(file_get_contents($url));
        
        $this->clearTable('artskart');
        
        for($i = 0; $i < $s->TotalPages; $i++){
            $pageIndex = ($pageSize * $i);
            
            $url = 'http://artskart2.artsdatabanken.no/Api/Observations/list?pageIndex='.$pageIndex.'&pageSize='.$s->TotalCount.'&Taxons='.$taxons;
            $a = json_decode(file_get_contents($url));
            
            
            foreach($a->Observations as $key => $value){
            $this->insert([
                    'taxonID' => $value->TaxonId,
                    'lat' => $value->Longitude,
                    'lng' => $value->Latitude,
                ], 'artskart');
            }
            
        }
        
        return ['loops' => $i];
    }
    
    public function index($p){ 
        $data = $this->query("SELECT * FROM blacklist WHERE TaxonID = :id", ['id' => $p['id']])->fetch();
        
        $taxon = Taxon::byId($data['taxonID']);
        if($groups = Taxon::getHigherClassification($taxon)){
            foreach($groups as $key => $value){
                $groups[$key] = '<div class="section">'.$value.'</div>';
            }
            $groups = implode('<i class="right chevron icon divider"></i>', $groups);
        }
        
        return View::make('recipie', [
            'groups' => $groups,
            'taxon' => $taxon,
            'data' => $data,
            'groupName' => Taxon::getGroupName($taxon),
        ]);
    }
    
    public function recipies(){
        
        return View::make('recipies');
    }
    public function about() {
    	
    	return View::make('about');
    }
}