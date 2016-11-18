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
class AdminController extends BaseController {

    public function index(){
        $species = $this->query('SELECT b.*, im.small, count(i.id) as recipes
            FROM blacklist AS b
            LEFT JOIN ingredients AS i ON i.taxonID = b.taxonID
            LEFT JOIN image AS im ON b.image = im.id 
            GROUP BY b.id
            ORDER BY b.navn, b.canEat')->fetchAll();
        
        return View::make('admin.index', [
            'sepcies' => $species,
        ]);
        
    }
}
