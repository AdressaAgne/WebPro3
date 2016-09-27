<?php
namespace App\Controllers;

use View, Direct, Route; // Routing
use Taxon, Csv, Maps; // APIs
use DB, BaseController, Migrations;
use App\Api\Populate as pop;

/**
 * making a view with/without variables to render
 * @return object View
 */
class LoginController extends BaseController {
    // run on get /
    
    public function index(){
        return View::make('login');
    }
    
    
    public function post(){ 
    
        return ['post' => 'sent'];
        
    }
}