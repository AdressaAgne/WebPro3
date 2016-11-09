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
        
        $result = DB::select(['*'], 'ingredients', ['id' => $this->id]);
        
        foreach($result as $i){
            $this->ingredients[] = $i;
        }

    }

    
    public function getIngrediets(){
        return $this->ingredients;
    }
    
    
}