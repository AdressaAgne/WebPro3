<?php
namespace App\Controllers;

use View, Direct, Route; // Routing
use Taxon, Csv, Maps; // APIs
use BaseController, Uploader;


class RecipieController extends BaseController {
    
    
    public function index() {
        
        return View::auth('insert.recipie');
    }
    
    public function put($values) {
        
        $id = $this->insert([[
            'name' => $values['name'],
            'how' => $values['how'],
            'description' => $values['description'],
            'image' => $values['file'],
            'user_id' => (isset($_SESSION['uuid']) ? $_SESSION['uuid'] : 0),
        ]], 'recipies');
        
        $data = [];
        $values['amount'];
        $values['unit'];
        foreach($values['ingredient'] as $key => $val){
            $data[] = [
                'recipie_id' => $id,
                'unit' => $values['unit'][$key],
                'amount' => $values['amount'][$key],
                'name' => $val,
            ];
        }
        
        $this->insert($data, 'ingredients');
        
        return Direct::re('/recipie/item/'.$id);
    }
    
    public function upload($values){
        $up = new Uploader($_FILES['file']);
        
        return ['path' => $up->upload()];
    }
    
}