<?php
namespace App\Controllers;

use View, Direct;
use DB, BaseController, Migrations;
use Account;

class LoginController extends BaseController{

    public function index(){
        return View::make('login');
    }

    public function post($user){
        $msg = Account::login($user['username'], $user['password'], isset($user['remember']));
        if($msg !== true){
            return View::make('login', ['login_msg' => $msg]);
        }
        return Direct::re('/profile');
    }
    
    public function logout(){
        Account::logout();
        Direct::re('/login');
    }

    public function reg($user){
        $msg = Account::register($user['username'], $user['password'], $user['password_confirm'], $user['mail']);

        
        if(intval($msg) > 0){
            return View::make('login', ['username' => $user['username']]);
        }
        
        return View::make('login', ['register_msg' => $msg]);
        
    }
}
