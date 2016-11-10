<?php

namespace App\Database;

use DB;

class Migrations{

    public static function install(){
        //$name, $type, $default = null, $not_null = true, $auto_increment = false)
        $db = new DB();
        $db->clearOut();

        // blacklisted species
        $db->createTable('blacklist', [
            new Row('id', 'int', null, true, true),
            new Row('scientificName', 'varchar'),
            new Row('navn', 'varchar'),
            new Row('svalbard', 'boolean', '0'),
            new Row('risiko', 'varchar'),
            new Row('taxonID', 'int'),
            new Row('canEat', 'boolean', '0'),
            new Row('family', 'varchar'),
        ]);

        //lat lng locations for opserved species
        $db->createTable('artskart', [
            new Row('id', 'int', null, true, true),
            new Row('taxonID', 'int'),
            new Row('lat', 'FLOAT(10,6)'),
            new Row('lng', 'FLOAT(10,6)'),
        ]);

        // a recipie
        $db->createTable('recipies', [
            new Row('id', 'int', null, true, true),
            new Row('name', 'varchar'),
            new Row('description', 'text'),
            new Row('image', 'text'),
            new Row('how', 'text'),
        ]);

        // a ingredient for a recipie
        $db->createTable('ingredients', [
            new Row('id', 'int', null, true, true),
            new Row('name', 'varchar'),
            new Row('amount', 'float'),
            new Row('unit', 'varchar'),
            new Row('recipie_id', 'int'),
        ]);

        // User Account
        $db->createTable('users', [
            new Row('id', 'int', null, true, true),
            new Row('username', 'varchar'),
            new Row('password', 'varchar'),
            new Row('cookie', 'varchar'),
            new Row('name', 'varchar', null, true, false, 'UNIQUE'),
            new Row('mail', 'varchar'),
        ]);

        // connect the recipies and user
        $db->createTable('user_recipie', [
            new Row('id', 'int', null, true, true),
            new Row('user_id', 'int'),
            new Row('recipie_id', 'int'),
        ]);

        $db->createTable('places', [
            new Row('id', 'int', null, true, true),
            new Row('name', 'varchar(255)'),
            new Row('lat', 'FLOAT(10,6)'),
            new Row('lng', 'FLOAT(10,6)'),
        ]);

        $db->createTable('image', [
            new Row('id', 'int', null, true, true),
            new Row('user_id', 'int'),
            new Row('location', 'varchar'),
        ]);
        
        
        $db->createTable('category', [
            new Row('id', 'int', null, true, true),
            new Row('name', 'varchar'),
            new Row('type', 'varchar'),
        ]);
        
        
        $db->createTable('recipie_category', [
            new Row('id', 'int', null, true, true),
            new Row('recipie_id', 'int'),
            new Row('category_id', 'int'),
        ]);

    }
}
