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
            'food' => ['Kjørvel', 'Kongekrabbe']
        ]);
    }
    
    public function recipie($p){ 
        
        return View::make('recipie', [
            'taxon' => $p['taxon'],
        ]);
    }
    
    public function recipies(){
        
        return View::make('recipies');
    }
    public function about() {
    	
    	return View::make('about');
    }
}