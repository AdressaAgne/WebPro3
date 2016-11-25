<?php
namespace App\Controllers;

use View, Direct, Route; // Routing
use Taxon, Csv, Maps; // APIs
use BaseController, Uploader, Recipie, Account;


class RecipieController extends BaseController {

    public function recipie($p){
        $recipie = $this->query('SELECT r.*, i.big as image, i.small as thumbnail
        FROM recipies AS r
        JOIN image AS i ON r.image = i.id WHERE r.id = :id', ['id' => $p['id']])->fetch();

        return View::make('recipie', [
            'recipie' => new Recipie($recipie),
        ]);
    }

    public function recipies(){

        $resipies = $this->query('SELECT r.*, i.big as image, i.small as thumbnail FROM recipies AS r
         JOIN image AS i ON r.image = i.id', 'Recipie')->fetchAll();


        return View::make('recipies', [
            'food' => $resipies,
            'category_zero' => $this->select(['*'], 'category', ['type' => 0])->fetchAll(),
            'category_one' => $this->select(['*'], 'category', ['type' => 1])->fetchAll(),
        ]);
    }


    public function index() {

        return View::make('insert.recipie',[
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

    public function writeComment($values){
        $this->insert([[
            'user_id' => Account::get_id(),
            'content' => $values['content'],
            'recipe_id' => $values['id'],
        ]], 'comments');

        return Direct::re('/recipie/item/'.$values['id']."#comments");

    }

    public function rate($values){
        if($this->select(['rating'], 'ratings', ['recipe_id' => $values['id'], 'user_id' => Account::get_id()])->rowCount() > 0){

            return $this->update(['rating' => $values['rating']], 'ratings', ['user_id' => Account::get_id(), 'recipe_id' => $values['id']]);

        } else {

            return $this->insert([[
                'user_id'=> Account::get_id(),
                'recipe_id' => $values['id'],
                'rating' => $values['rating'],
            ]],'ratings');
        }
    }

    public function sorting($str){
      //if alfabetisk
      $query = 'SELECT r.*, i.big as image, i.small as thumbnail, (SUM(ra.rating) / count(ra.id)) as rating
              FROM recipies AS r
              JOIN image AS i ON r.image = i.id
              LEFT JOIN ratings AS ra ON ra.recipe_id = r.id
              GROUP BY r.id
              ORDER BY ';

      switch($str['sortingMethod']){

        case 'nyeste' :
          $query .= 'r.time DESC';
          break;
        case 'beste' :
          $query .= 'rating DESC';
          break;
        case 'alfabetisk' :

          if(!isset($_SESSION['alfabetical'])){
            $_SESSION['alfabetical'] = false;
          }
          if($_SESSION['alfabetical'] == false){
            $query .= 'r.name ASC';
            $_SESSION['alfabetical'] = true;
          }else{
            $query .= 'r.name DESC';
            $_SESSION['alfabetical'] = false;
          }
          break;
        default :
          $query .= 'rating DESC'; //Shows highest ranked as default
      }

      $result = $this->query($query, 'Recipie')->fetchAll();


      return View::make('layout.recipes_cat_sort', ['result' => $result]);
    }//sort()

    public function categorySort($data){


      if(!isset($data['id'])) {

        $query = $this->query('SELECT r.*, i.big as image, i.small as thumbnail FROM recipies AS r
           JOIN image AS i ON r.image = i.id', 'Recipie')->fetchAll();

      } else {
        $ids = [];
        $idData = [];
        foreach($data['id'] as $key => $id){
          $idData['id'.$key] = $id;
          $ids[] = ':id'.$key;
        }

        $query = $this->query('SELECT *, i.small AS thumbnail FROM recipie_category AS rc
	    	INNER JOIN category AS c ON rc.category_id = c.id
	    	INNER JOIN recipies AS r ON r.id = rc.recipie_id
	    	INNER JOIN image AS i ON r.image = i.id
	    	WHERE c.id IN ('.implode(', ', $ids).')', $idData, 'Recipie');

      }

      return View::make('layout.recipes_cat_sort', [
    		'result' => $query
     	]);
      //return "Sort TODO";
    }

}
