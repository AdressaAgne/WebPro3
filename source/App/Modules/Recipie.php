<?php

namespace App\Modules;

use DB;

class Recipie{
    
    public $id;
    public $name;
    public $desc;
    public $how;
    public $image;
    
    public $ingredients = [];
    
    public function __construct($query){
        $this->id       = $query['id'];
        $this->name     = $query['name'];
        $this->desc     = $query['description'];
        $this->how      = $query['how'];
        $this->image    = $query['image'];  
        
        $result = DB::select(['*'], 'ingredients', ['recipie_id' => $this->id])->fetchAll();

        foreach($result as $i){
            $this->ingredients[$i['id']] = new Ingredient($i, 'metric');
        }

    }

    
    public function getIngrediets(){
        return $this->ingredients;
    }
    
    
}