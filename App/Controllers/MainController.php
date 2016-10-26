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
class MainController extends BaseController {
    
    public function test(){
        return View::make('index', [
            'food' => ['fisk', 'laks', 'mat', 'ball', 'mia']
        ]);
    }
    
    public function index($p){ 
    
        $db = new DB();
        $data = $db->query("SELECT * FROM blacklist WHERE TaxonID = :id", ['id' => $p['id']])->fetch();
        
        $taxon = Taxon::byId($data['taxonID']);
        if($groups = Taxon::getHigherClassification($taxon)){
            foreach($groups as $key => $value){
                $groups[$key] = '<div class="section">'.$value.'</div>';
            }
            $groups = implode('<i class="right chevron icon divider"></i>', $groups);
        }
        
        return View::make('recipie', [
            'groups' => $groups,
            'taxon' => $taxon,
            'data' => $data,
            'groupName' => Taxon::getGroupName($taxon),
        ]);
    }
    
    public function recipies(){
        
        return View::make('recipies');
    }
    
}