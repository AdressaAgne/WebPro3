<?php

namespace App\Database;

use DB;

class Migrations{
        
    public static function install(){
        //$name, $type, $default = null, $not_null = true, $auto_increment = false)
        return DB::createTable('blacklist', [
            new Row('id', 'int', null, true, true),
            new Row('scientificName', 'varchar'),
            new Row('navn', 'varchar'),
            new Row('svalbard', 'boolean', '0'),
            new Row('risiko', 'varchar'),
            new Row('taxonID', 'int'),
        ]);
    }
    
}