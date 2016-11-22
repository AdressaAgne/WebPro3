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
}
