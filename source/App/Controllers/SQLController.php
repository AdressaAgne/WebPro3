<?php
namespace App\Controllers;

use DB, Account, User, Comment, Ingredient, Recipie;

class SQLController extends DB{
    
    private $sql = [
      'recipie' => '
        SELECT r.*, rate.rating as rating, i.big as image, i.small as thumbnail
        FROM recipies AS r
        INNER JOIN image AS i ON r.image = i.id
        LEFT JOIN ratings AS rate ON rate.recipe_id = r.id
        ORDER BY rating DESC LIMIT 2
      ',  
        
    ];
    
    public function preset($table = 'recipie', $class = 'Recipie'){
        
        $query = $this->query($this->sql[$table])->fetchAll();
        
        return $query;
        
    }
    
    
}