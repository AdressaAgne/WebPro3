<?php
namespace App\Controllers;

use View, Direct; // Routing
use User, Account, Uploader;

/**
 * making a view with/without variables to render
 * @return object View
 */
class ProfileController extends Controller {

    public function index(){
        return View::make('profile');
    }

    public function edit($param){
        $user = new User($_SESSION['uuid']);
        $msg = $user->changePassword($param['old_pw'], $param['new_pw'], $param['new_pw2']);

        if(gettype($msg) == 'string'){
            return View::make('edit.profile', ['msg' => $msg]);
        }

        return Direct::re('/profile');
    }

    public function profieEdit(){
        return View::make('edit.profile');
    }

    public function ajaxUpload($values){
        $up = new Uploader($_FILES['file']);
        $up = $up->upload();

        $this->update(['image' => $up['id']],'users', ['id' => Account::get_id()]);

        return ['path' => $up['folder'], 'id' => $up['id']];
    }

    public function getFavoriteRecipes(){

      $recipes = $this->query('SELECT r.*, i.big as image, i.small as thumbnail, AVG(ra.rating) as rating
       FROM recipies AS r
       INNER JOIN image AS i ON r.image = i.id
       LEFT JOIN ratings AS ra ON ra.recipe_id = r.id
       INNER JOIN favorites AS f ON r.id = f.recipe_id AND f.user_id = :uuid
       GROUP BY r.id
       ORDER BY rating desc', ['uuid' => Account::get_id()], 'Recipie')->fetchAll();


      return View::make("favoritter", ['recipe' => $recipes]);
    }//getFavorites()
}
