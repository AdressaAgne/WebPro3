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
class MigrateController extends BaseController {
    
    public function migrate(){
        
        $m = Migrations::install();
        
        $p = pop::run();
        
        return ['database was reset' => true, 'tables' => count($m), 'Migration' => $m, 'population' => $p];
    }
    
    public function populate(){
        return Migrations::populate();
    }
}