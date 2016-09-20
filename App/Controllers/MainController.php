<?php
namespace App\Controllers;

use View, Direct, Route; // Routing
use Taxon, Csv, Maps; // APIs
use DB;

/**
 * making a view with/without variables to render
 * @return object View
 */
class MainController {
    // run on get /
    
    public static function test(){
        
        return View::make('index', [
            'var' => 'This is a var',
            'raw' => '<em>Raw output</em>',
            'arr' => [
                'hi' => 'you',
                'hello' => 'okey',
                'i love you' => 'thanks...'
            ],
        ]);
    }
    
    
    public static function index(){ 
        $db = new DB();
        $data = $db->query("SELECT * FROM blacklist WHERE TaxonID = :id", ['id' => $_GET['id']])->fetch();
        
        $taxon = Taxon::byId($data['taxonID']);
        $groups = Taxon::getHigherClassification($taxon);
        foreach($groups as $key => $value){
            $groups[$key] = '<div class="section">'.$value.'</div>';
        }
        
        $groups = implode('<i class="right chevron icon divider"></i>', $groups);
        
        return View::make('recipie', [
            'groups' => $groups,
            'taxon' => $taxon,
            'data' => $data,
            'groupName' => Taxon::getGroupName($taxon),
        ]);
    }
    
    public static function error(){
        return ['error' => "page does not exist, error 404"];
    }
}