<?php
namespace App\Controllers;

use View, Direct, Route; // Routing
use Taxon, Csv, Maps; // APIs
use BaseController, Uploader;


class RecipieController extends BaseController {
    
    
    public function index() {
        
        return View::auth('insert.recipie', '/login', [
            'cat' => $this->select(['*'], 'category')->fetchAll()
        ]);
    }
    
    public function put($values) {
        $userid = (isset($_SESSION['uuid']) ? $_SESSION['uuid'] : 0);
        $id = $this->insert([[
            'name' => $values['name'],
            'how' => $values['how'],
            'description' => $values['description'],
            'image' => $values['file'],
            'user_id' => $userid,
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
        
        if(!empty($values['cat'])){
            $categories = [];
            foreach($values['cat'] as $cat){
                $categories[] = [
                    'category_id' => $cat,
                    'recipie_id' => $id
                ];
            }
            $this->insert($categories, 'recipie_category');
        }
        
        $this->insert($data, 'ingredients');
        
        return Direct::re('/recipie/item/'.$id);
    }
    
    public function ajaxUpload($values){
        $up = new Uploader($_FILES['file']);
        $up = $up->upload();
        return ['path' => $up['folder'], 'id' => $up['id']];
    }
    
}