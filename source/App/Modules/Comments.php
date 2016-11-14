<?php

namespace App\Modules;

use DB;

class Comment{

    public $id;
    public $user_id;
    public $content;
    public $recipe_id;

    public $ingredients = [];

    public function __construct($query){
        $this->id           = $query['id'];
        $this->user_id      = $query['user_id'];
        $this->content      = $query['content'];
        $this->recipe_id    = $query['recipe_id'];
    }

    public function getRecipe(){
      $query = DB::select(['*'], 'recipies', ['id' => $this->recipe_id])->fetch();
      return new Recipe($query);
    }//getRecipe()

    public function getUser(){
      return new User($this->user_id);
    }//getUser()

}
