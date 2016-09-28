<?php

namespace App\Auth;

use DB, Config;

class Accounts {
    
    
    public function login($username, $password, $remember = false){
        
        $user = DB::query('SELECT * FROM users WHERE username = :uname LIMIT 1', ['uname' => $username])->fetch();
        
        if(!password_verify($password, $user['password'])) return false;
        
        if($remember) {
            $cookie = sha1(uniqid());
            DB::query('UPDATE users SET cookie=:c WHERE id = :id', ['c' => $cookie, 'id' => $user['id']]);
            $this->setCookie('remberme', $user['cookie']);
        } else {
            $this->removeCookie('remberme');
        }
        
        $_SESSION['uuid'] = $user['id'];
        
        return true;
    }
    
    public function register(...$args){
        
        foreach($args as $arg){
            
            
            
        }
        
    }
    
    public function setCookie($name, $value){
        setcookie($name, $value, time()+Config::$cookie_time);
    }
    
    public function removeCookie($name){
        unset($_COOKIE[$name]);
        setcookie($name, null, -1);
    }
    
    public static function isLoggedIn(){
        return isset($_SESSION['uuid']);
    }
    
}