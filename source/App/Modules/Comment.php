<?php

namespace App\Modules;

use DB;

class Comment{

    public $id;
    public $user_id;
    public $content;
    public $recipe_id;

    public $ingredients = [];
    public $user;

    public function __construct($query){
        $this->id           = $query['id'];
        $this->user_id      = $query['user_id'];
        $this->content      = $query['content'];
        $this->recipe_id    = $query['recipe_id'];
        $this->user = new User($query);
    }


    public function getRecipe(){
      return new Recipie($this->user_id);
    }//getUser()

}
