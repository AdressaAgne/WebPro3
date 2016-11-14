<?php

namespace App\Modules;

use DB;

class Recipie{

    public $id;
    public $name;
    public $desc;
    public $how;
    public $image;

    public $comments = [];
    public $ingredients = [];

    public function __construct($query){
        $this->id       = $query['id'];
        $this->name     = $query['name'];
        $this->desc     = $query['description'];
        $this->how      = $query['how'];
        $this->image    = $query['image'];
    }


    public function getIngrediets(){
      if(!empty($this->ingredients)) return $this->ingredients;
        $result = DB::select(['*'], 'ingredients', ['recipie_id' => $this->id])->fetchAll();
        foreach($result as $i){
            $this->ingredients[$i['id']] = new Ingredient($i, 'metric');
        }
        return $this->ingredients;
    }//getIngrediets()

    public function getComments(){
      if(!empty($this->comments)) return $this->comments;
      $query = DB::select(['*'], 'comments', ['recipie_id' => $this->id])->fetchAll();
      foreach($query as $key => $value){
        $this->comments[$value['id']] = new Comment($value);
      }
      return $this->comments;
    }//getComments()


}
