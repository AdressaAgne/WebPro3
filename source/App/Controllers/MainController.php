<?php
namespace App\Controllers;

use View, Direct, Route; // Routing
use Taxon, Csv, Maps; // APIs
use BaseController, Migrations, Row;
use App\Api\Populate as pop;

use Recipie;

/**
 * making a view with/without variables to render
 * @return object View
 */
class MainController extends BaseController {
    
    public function test(){
        
        return View::make('index', [
            'food' => $this->all(['*'], 'recipies'),
        ]);
    }
    
    public function recipie($p){ 

        return View::make('recipie', [
            'recipie' => new Recipie($this->select(['*'], 'recipies', ['id' => $p['id']])->fetch()),
        ]);
    }
    
    public function recipies(){
        
        $resipies = $this->all(['*'], 'recipies');
        foreach($resipies as &$recipie){
            $recipie = new Recipie($recipie);
        }
        
        return View::make('recipies', [
            'food' => $resipies,
        ]);
    }
    public function about() {
    	
    	return View::make('about');
    }
    
    public function species() {
    	
    	return View::make('taxons', [
            'taxon' => $this->query('SELECT * FROM blacklist WHERE taxonID = :a OR taxonID = :b OR taxonID = :c OR taxonID = :d OR taxonID = :e OR taxonID = :f', [
                'a' => 60303,
                'b' => 14365,
                'c' => 84141,
                'd' => 38890,
                'e' => 26171,
                'f' => 3457,
            ])->fetchAll(),
        ]);
    }
    
    
    public function specie($p) {
//
//        $tax = Taxon::byID($p['taxon']);
//        $group = Taxon::getGroupName($tax);
//        
    	return View::make('taxon', [
            'taxon' => $this->query('SELECT * FROM blacklist WHERE taxonID = :a', [
                'a' => $p['taxon']
            ])->fetch(),
            'oppskrift' => $this->query('SELECT r.* FROM recipies as r
            INNER JOIN ingredients as i ON i.recipie_id = r.id WHERE i.taxonID = :taxon',['taxon' => $p['taxon']])->fetchAll(),
        ]);
    }
}