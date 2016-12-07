<?php
namespace App\Controllers;

use View, Direct, Route; // Routing
use Taxon, Csv, Maps; // APIs
use BaseController, Migrations, Row;


/**
 * making a view with/without variables to render
 * @return object View
 */
class ApiController extends BaseController {


    public function index(){
        return $this->query("SELECT * FROM blacklist WHERE image != 1");
    }
    
    public function image(){
        return $this->query("SELECT small, big, id, time FROM image")->fetchAll();
    }
    
    public function check(){
        
        return [
            'name' => 'farliggodtapp',
            'version' => 0.1,
            'api' => [
                'blacklist' => '/api/blacklist',
                'version' => '/api/check',
                'taxon_location' => '/api/taxon/',
                'nearby' => '/api/nearby/',
            ]
        ];
        
    }
    
    
}
