<?php
namespace App\Controllers;

use \App\View as View;
use \App\Routing\Direct as Direct;
use \App\Routing\Route as Route;


use \App\Api\Taxon as Taxon;
use \App\Api\Csv as Csv;
use \App\Api\Maps as Maps;
use \App\Database\Database as DB;

/**
 * making a view with/without variables to render
 * @return object View
 */
class MainController {
    // run on get /
    public static function index(){ 
        

        $_GET['id'] = "84141";

        $db = new DB();
        $data = $db->query("SELECT * FROM blacklist WHERE TaxonID = :id", ['id' => $_GET['id']])->fetch();
        
        $taxon = Taxon::byId($data['taxonID']);
        $groups = Taxon::getHigherClassification($taxon);
        foreach($groups as $key => $value){
            $groups[$key] = '<div class="section">'.$value.'</div>';
        }
        
        $groups = implode('<i class="right chevron icon divider"></i>', $groups);
        
        return View::make('index', [
            'groups' => $groups,
            'taxon' => $taxon,
            'data' => $data,
            'groupName' => Taxon::getGroupName($taxon),
        ]);
    }
    
//    // run on get /test
//    public static function test(){
//        return View::make('test',[
//            'routes' => Route::lists()
//        ]);
//    }
//    
//    // This function is run on post /
//    public static function insert(){
//        Image::insert([
//            'ball' => uniqid(),
//            'snerk_id' => $_POST['submit'],
//            'ultra_snerk' => 'veldig'
//        ]);
//        return Direct::re('/');
//    }
//    
//    public static function delete(){
//        Image::all()->where($_POST['id'])->delete();
//        return Direct::re('/');
//    }
//    
//    public static function api(){
//        return Image::all()->desc();
//    }
}