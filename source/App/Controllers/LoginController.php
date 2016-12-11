<?php
namespace App\Controllers;

use View, Direct;

use Account;

class LoginController extends Controller{

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
        //$defaut_register_rank = 1; Her vi må sette default Rank for "ny registrert" bruker Agne ?
        $msg = Account::register($user['username'], $user['password'], $user['password_confirm'], $user['mail']);


        if(intval($msg) > 0){
            return Direct::re('/login');
        }

        return View::make('login', ['register_msg' => $msg]);

    }
}
