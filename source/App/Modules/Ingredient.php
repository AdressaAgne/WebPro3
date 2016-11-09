<?php

namespace App\Modules;

use DB;

class Ingredient{
    
    public $id;
    public $name;
    public $amount;
    public $unit;
    public $recipie_id;
    public $taxonID;
    
    
    public function __construct($query){
        $this->id           = $query['id'];
        $this->name         = $query['name'];
        $this->amount       = $query['amount'];
        $this->unit         = $query['unit'];
        $this->recipie_id   = $query['recipie_id'];  
        $this->taxonID      = $query['taxonID'];  
    }
    
}