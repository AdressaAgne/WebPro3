<?php
namespace App\Controllers;

use Migrations;

/**
 * making a view with/without variables to render
 * @return object View
 */
class MigrateController extends BaseController {
    
    public function migrate(){
        
        $m = Migrations::install();
        
        
        return ['database was reset' => true, 'tables' => count($m), 'Migration' => $m];
    }
    
    public function populate(){
        return Migrations::populate();
    }
}