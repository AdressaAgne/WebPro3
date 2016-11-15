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
    public $categories = [];

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
    }

    public function getCategories(){
        if(!empty($this->categories)) return $this->categories;
        
        $result = DB::query('SELECT * FROM recipie_category as rc
        INNER JOIN category AS c ON rc.category_id = c.id WHERE rc.recipie_id = :id', ['id' => $this->id])->fetchAll();
        
        foreach($result as $cat){
            $this->categories[$cat['id']] = $cat['name'].($cat['type'] == 0 ? ' (Råvare)' : ' (Type Rett)');
        }
        
        return $this->categories;
    }

    public function getComments(){
        if(!empty($this->comments)) return $this->comments;
        
        $query = DB::select(['*'], 'comments', ['recipie_id' => $this->id])->fetchAll();
        
        foreach($query as $key => $value){
            $this->comments[$value['id']] = new Comment($value);
        }
        
        return $this->comments;
    }

    public function rate_recipe($user_id, $rating){
        if(DB::select(['rating'], 'ratings', ['recipe_id' => $this->id, 'user_id' => $user_id])->rowCount() > 0){
            return DB::update(['rating' => $rating], 'ratings', ['user_id' => $user_id, 'recipe_id' => $this->id]);
        } else {
            return DB::insert([[
                'user_id'=> $user_id,
                'recipe_id' => $this->id,
                'rating' => $rating
            ],'ratings']);
        }
    }

    public function display_ratings(){
        $query = DB::select(['AVG(rating)'], 'ratings', ['recipe_id' => $this->id]);
      
        return round($query);
    }

    //ongoing
    public function changeImage($id){

      
        return DB::update(['image' => $id], 'recipies', ['id' => $this->id]);
    }

}