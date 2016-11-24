<?php

namespace App\Controllers;
use Account, User;

class Controller extends SQLController{
    
    public static $site_wide_vars = [
        'user' => null,
        'google_key' => 'AIzaSyC7i0o5mdEYSbG_wqoWAx53tAP1xxTKVQo',
    ];
    
    /**
     * This code runs with all controllers
     * @private
     * @author Agne *degaard
     */
    public function __construct(){
        parent::__construct();
        
        if(Account::isLoggedIn()){
            self::$site_wide_vars['user'] = new User($_SESSION['uuid']);
        }
    }
}