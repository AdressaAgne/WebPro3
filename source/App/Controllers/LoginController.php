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
        $msg = Account::login($user['username'], $user['password']);
        
        return Direct::re('/profile');
    }
    
    public function logout(){
        Account::logout();
        Direct::re('/login');
    }

    public function reg($user){
        $msg = Account::register($user['username'], $user['password'], $user['password_confirm'], $user['mail']);

        return Direct::re('/login', ['username' => $user['username'],
                                     'mail'    => $user['mail'],
                                     'message' => $msg]);
    }
}
