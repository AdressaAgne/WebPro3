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
        return $this->query("SELECT b.*, i.small as image FROM blacklist as b
                INNER JOIN image AS i ON i.id = b.image
                WHERE image != 1")->fetchAll();
    }
    
    public function image(){
        return $this->query("SELECT small, big, id, time FROM image")->fetchAll();
    }
    
    public function check(){
        
        return [
            'name' => 'farliggodtapp',
            'version' => 0.3,
            'api' => [
                'blacklist' => '/api/blacklist',
                'version' => '/api/check',
                'taxon_location' => '/api/taxon/',
                'nearby' => '/api/nearby/',
            ]
        ];
        
    }
    
    
}
