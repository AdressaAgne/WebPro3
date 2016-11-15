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

    public function rate_recipe($user_id, $rating){
      ///if empty -> update, else -> create rating
      if(DB::select(['rating'], 'ratings', ['recipe_id' => $this->id, 'user_id' => $user_id])->rowCount() > 0){
        return DB::upadte(['rating' => $rating], 'ratings', ['user_id' => $user_id, 'recipe_id' => $this->id]);
      }else{
        return DB::insert([[
          'user_id'=> $user_id,
          'recipe_id' => $this->id,
          'rating' => $rating
        ],'ratings']);
      }
    }//rate_recipe()

    public static function display_ratings(){
      $query = DB::select(['AVG(rating)'], 'ratings');
      return round($query);
      //$this->avg_rating = blabla;
    }

    public function changeImage($id){//existing image_id

      //ongoing
      return DB::update(['image' => $id], 'recipies', ['id' => $this->id]);
    }//changeImage()

}
