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
class SpeciesController extends BaseController {


    public function index() {

    	return View::make('taxons', [
            'taxon' => $this->query('SELECT b.*, im.big as image, im.small as thumbnail FROM blacklist as b
             INNER JOIN image as im ON b.image = im.id
            WHERE taxonID IN (SELECT taxonID from blacklist WHERE image != 1)')->fetchAll(),
            'categories' => $this->select(['*'], 'category', ['type' => 0])
        ]);
    }


    public function item($p) {
        
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