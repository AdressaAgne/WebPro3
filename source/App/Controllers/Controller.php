<?php

namespace App\Controllers;
use DB, Account;

class Controller extends DB{
    
    public static $site_wide_vars = [
        'user' => null,
        'google_key' => 'AIzaSyC7i0o5mdEYSbG_wqoWAx53tAP1xxTKVQo',
    ];
    
    public function __construct(){
        parent::__construct();
        
        if(Account::isLoggedIn()){
            $this->site_wide_vars['user'] = $this->query('SELECT * FROM users WHERE id = :id', ['id' => $_SESSION['uuid']]);
        }
        
        //This code runs on all pages;
    }
}