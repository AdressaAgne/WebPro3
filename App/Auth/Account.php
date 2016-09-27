<?php

namespace App\Auth;

use DB;

class Accounts {
    
    
    public function login($username, $hash, $remember = false){
        
        
        
    }
    
    
    public static function isLoggedIn(){
        return isset($_COOKIE['uuid']);
    }
    
}