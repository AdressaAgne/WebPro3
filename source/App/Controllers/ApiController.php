<?php
namespace App\Controllers;

use View;


/**
 * making a view with/without variables to render
 * @return object View
 */
class ApiController extends Controller {


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
