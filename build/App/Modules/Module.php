<?php

namespace App\Modules;

class Module{
    /**
     * Return a new instance of class
     * @author Agne *degaard
     * @return object
     */
    public function a(){
        return new static();
    }
    
}