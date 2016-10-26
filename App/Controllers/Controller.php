<?php

namespace App\Controllers;
use DB;

class Controller extends DB{
    
    public static $site_wide_vars = [
        
    ];
    
    public function __construct(){
        parent::__construct();
        
        //This code runs on all pages;
    }
}