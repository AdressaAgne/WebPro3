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
    
    public function index(){

        $ratings = $this->query('SELECT r.*, rate.rating as rating, i.big as image, i.small as thumbnail
        FROM recipies AS r
        INNER JOIN image AS i ON r.image = i.id
        INNER JOIN ratings AS rate ON rate.recipe_id = r.id
        ORDER BY rating DESC LIMIT 2', 'Recipie')->fetchAll();
        
        
        $newest = $this->query('SELECT r.*, i.big as image, i.small as thumbnail
        FROM recipies AS r
        INNER JOIN image AS i ON r.image = i.id
        ORDER BY time DESC LIMIT 2', 'Recipie')->fetchAll();
        
        return View::make('index', [
            'ratings' => $ratings,
            'newest' => $newest,
        ]);
    }
    
    public function about() {

    	return View::make('about');
    }
}
