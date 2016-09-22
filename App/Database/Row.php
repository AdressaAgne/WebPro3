<?php

namespace App\Database;

class Row {
    
    public $name;
    public $type;
    public $not_null;
    public $defaults;
    public $auto_increment;
    
    
    public function __construct($name, $type, $default = null, $not_null = true, $auto_increment = false){
        
        $this->name = $name;
        $this->type = $type;
        $this->defaults = $default;
        $this->not_null = $not_null;
        $this->auto_increment = $auto_increment;
        
    }
    
}