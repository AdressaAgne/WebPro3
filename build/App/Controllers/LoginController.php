<?php
namespace App\Controllers;

use View, Direct, Route; // Routing
use Taxon, Csv, Maps; // APIs
use DB, BaseController, Migrations;
use Account;

/**
 * making a view with/without variables to render
 * @return object View
 */
class LoginController extends BaseController{
    // run on get /

    public function index(){
        return View::make('login');
    }


    public function post($p){
      return ['login' => $p];
    }

    public function reg($user){

        $msg = Account::register($user['username'], $user['password'], $user['password_confirm'], $user['mail']);

        return ['user' => $user, 'msg' => $msg];
        return Direct::re('/login', ['username' => $user['username'],
                                     'mail'    => $user['mail'],
                                     'message' => $msg]);

    }
}
