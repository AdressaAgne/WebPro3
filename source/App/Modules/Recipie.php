<?php

namespace App\Modules;

use DB;

class Recipie{

    public $id;
    public $name;
    public $description;
    public $how;
    public $image;
    public $thumbnail;
    public $user_id;
    public $rating;
    public $approved;

    public $comments = [];
    public $ingredients = [];
    public $categories = [];

    public function __construct($query = null){
        if($query != null){
            $this->id           = $query['id'];
            $this->name         = $query['name'];
            $this->description  = $query['description'];
            $this->how          = $query['how'];
            $this->image        = $query['image'];
            $this->thumbnail    = $query['thumbnail'];
            $this->user_id      = $query['user_id'];
            $this->user_id      = $query['user_id'];
            $this->approved     = $query['approved'];
        }
    }

    public function getUser(){
        return new User($this->user_id);
    }//getUser()

    public function getIngrediets(){
        if(!empty($this->ingredients)) return $this->ingredients;

        $this->ingredients = DB::select(['*'], 'ingredients', ['recipie_id' => $this->id], 'Ingredient')->fetchAll();

        return $this->ingredients;
    }

    public function getCategories(){
        if(!empty($this->categories)) return $this->categories;

        $this->categories = DB::query('SELECT * FROM recipie_category as rc
        INNER JOIN category AS c ON rc.category_id = c.id WHERE rc.recipie_id = :id', ['id' => $this->id])->fetchAll();


        return $this->categories;
    }

    public function getRelated(){

        $recipies = DB::query("SELECT r.*, im.big as image, (SUM(ra.rating) / count(ra.id)) as rating, im.small as thumbnail FROM recipies as r
            INNER JOIN ingredients as i ON i.recipie_id = r.id
            INNER JOIN image as im ON r.image = im.id
            LEFT JOIN ratings AS ra ON ra.recipe_id = r.id
            WHERE i.taxonID IS NOT NULL AND i.recipie_id != :id
            AND i.taxonID IN (SELECT taxonID FROM ingredients WHERE recipie_id = :id and taxonID != '')
            GROUP BY r.id
            ORDER BY rating",
            ['id' => $this->id, 'id' => $this->id], 'Recipie')->fetchAll();


        return $recipies;

    }

    public function getComments(){
        if(!empty($this->comments)) return $this->comments;

        $this->comments = DB::query('SELECT * FROM comments as c
        JOIN users AS u ON c.user_id = u.id
        JOIN image AS i ON u.image = i.id
        WHERE recipe_id = :id
        GROUP BY c.id', ['id' => $this->id], 'Comment')->fetchAll();

        return $this->comments;
    }

    public function getRecipeRating(){
        return DB::query("SELECT FLOOR(AVG(ra.rating)), count(ra.id)
        FROM ratings AS ra
        INNER JOIN recipies ON recipies.id = :id
        WHERE ra.recipe_id = :id", ['id' => $this->id])->fetch();
    }//getRecipeRating()


    //ongoing
    public function changeImage($id){


        return DB::update(['image' => $id], 'recipies', ['id' => $this->id]);
    }

    public function isApproved(){
      return ($this->approved > 0);
    }//isApproved

}
