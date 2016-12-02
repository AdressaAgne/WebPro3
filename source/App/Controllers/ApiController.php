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
        
        
        return Taxon::byID('84141');
        
    }
    
}
