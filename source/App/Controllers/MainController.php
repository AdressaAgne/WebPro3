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

    public function error(){
        return View::make('error.404');
    }
    
    public function test(){

        $recipies = $this->query('SELECT r.*, i.big as image, i.small as thumbnail FROM recipies AS r
        INNER JOIN image AS i ON r.image = i.id')->fetchAll();
        
        foreach($recipies as &$recipie){
            $recipie = new Recipie($recipie);
        }
        
        return View::make('index', [
            'food' => $recipies,
        ]);
    }
    
    public function about() {

    	return View::make('about');
    }

    public function species() {

    	return View::make('taxons', [
            'taxon' => $this->query('SELECT b.*, im.big as image, im.small as thumbnail FROM blacklist as b
             INNER JOIN image as im ON b.image = im.id
            WHERE taxonID = :a OR taxonID = :b OR taxonID = :c OR taxonID = :d OR taxonID = :e OR taxonID = :f OR taxonID = :g OR taxonID = :h OR taxonID = :i OR taxonID = :j OR taxonID = :k OR taxonID = :l OR taxonID = :m OR taxonID = :n OR taxonID = :o ORDER BY b.navn' , [
                'a' => 60303,
                'b' => 14365,
                'c' => 84141,
                'd' => 38890,
                'e' => 26171,
                'f' => 3457,
                'g' => 59373,
                'h' => 3413,
                'i' => 61212, 
                'j' => 31106,
                'k' => 31227,
                'l' => 60308, 
                'm' => 63574,
                'n' => 31237,
                'o' => 62346,
            ])->fetchAll(),
            'categories' => $this->select(['*'], 'category', ['type' => 0])
        ]);
    }


    public function specie($p) {
        
        $recipies = $this->query('SELECT r.*, im.big as image, im.small as thumbnail FROM recipies as r
            INNER JOIN ingredients as i ON i.recipie_id = r.id
            INNER JOIN image as im ON r.image = im.id
            WHERE i.taxonID = :taxon',['taxon' => $p['taxon']])->fetchAll();
        
        foreach($recipies as &$recipie){
            $recipie = new Recipie($recipie);
        }
        
    	return View::make('taxon', [
            'taxon' => $this->query('SELECT b.*, im.big as image, im.small as thumbnail, im.position as position FROM blacklist as b
            INNER JOIN image AS im ON b.image = im.id 
            WHERE taxonID = :a', [
                'a' => $p['taxon']
            ])->fetch(),
            'oppskrift' => $recipies,
        ]);
    }
}
