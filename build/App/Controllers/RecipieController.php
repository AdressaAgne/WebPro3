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
         JOIN image AS i ON r.image = i.id')->fetchAll();

        foreach($resipies as &$recipie){
            $recipie = new Recipie($recipie);
        }

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
      $query = 'SELECT r.*,ra.*, i.big as image, i.small as thumbnail, (ra.rating / count(ra.*)) as rating
              FROM recipies AS r
              JOIN image AS i ON r.image = i.id
              JOIN ratings as ra ON ra.recipe_id = r.id
              GROUP BY r.id
              ORDER BY ';

      switch($str['sortingMethod']){

        case 'nyeste' :
          $query += 'TIMESTAMP DESC';
          break;
        case 'beste' :
          $query += 'rating DESC';
          break;
        case 'alfabetisk' :
          $query += 'recipe DESC';
          break;
        default :
          $query += 'rating DESC'; //Shows highest ranked as default
      }

      $result = $this->select($query)->fetchAll();
      return View::make('recipes_sorted', ['result' => $result]);
    }//sort()

}
