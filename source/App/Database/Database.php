<?php

namespace App\Database;
use Config;
use PDO;

use Recipie, Comment, Ingredient, User;

class Database {
    public static $db;
    public static $table;

    /**
     * Init Database connection
     * @private
     * @param string $class Class called that extends Modul in \App\Modul
     */
    public function __construct(){
        try {

            $dns = 'mysql:host='.Config::$host;
            $dns .= ';dbname='.Config::$database;
            self::$db = new PDO($dns, Config::$username, Config::$password);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            self::$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            self::$db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);

        } catch (PDOException $e) {
             die('Could not connect to Database'. $e);
        }
    }

    public static function do(){
      return new self();
    }

    /**
     * Bind Values to PDO prepare
     * @param object   &$query
     * @param array  &$args
     */
    private static function arrayBinder(&$query, &$args) {
        foreach ($args as $key => $value) {
            $query->bindValue(':'.$key, htmlspecialchars($value));
        }
	}

    /**
     * Execute a PDO mysql Query
     * @param  string   $sql
     * @param  array    [$args                 = null]
     * @return object
     */
    public static function query($sql, $args = null, $class = null){
        $query = self::$db->prepare($sql);
        if($class !== null || gettype($args) == 'string'){
            $class = ($class == null) ? $args : $class;
            $query->setFetchMode(PDO::FETCH_CLASS, $class);
        }
        if($args !== null && gettype($args) == 'array'){
            self::arrayBinder($query, $args);
        }
        return $query->execute() ? $query : false;
    }
    //db::query("SELECT * from table where row = :value", ['value' => 'hei'])
    /**
     * Select * from class
     * @param  array  [$rows                  = ['*']]
     * @return object Table[Row object] Object
     */
    public static function all($rows = ['*'], $table = null){
        return self::query('SELECT '.implode(', ', $rows).' FROM '.$table)->fetchAll();
    }



    public static function select($rows = ['*'], $table = null, $data = null, $join = 'AND', $class = null){
        
        if($join == 'AND' || $join == 'OR'){
        } else {
            $class = $join;
        }
        
        $args = null;
        if($data != null){
            $arg = [];
            $args = $data;
            foreach($data as $key => $value){
                $arg[] = "$key = :$key";
            }
            $where = " WHERE ".implode(" $join ", $arg);
        } else {
            $where = "";
        }

        return self::query('SELECT '.implode(', ', $rows).' FROM '.$table.$where, $args, $class);
    }


    /**
     * Delete a row from a table
     * @param  string       [$col = 'id']   col name
     * @param  string       [$val = 0]      Value of col to delete
     * @param  string       [$table = null] Table name
     * @return object/false
     */
    public static function deleteWhere($col = 'id', $val = 0, $table = null){
        return self::query("DELETE FROM {$table} WHERE {$col} = :val", ['val' => $val]);
    }

    /**
     * clear a table
     * @param  string  $table MySQL table
     * @return boolean
     */
    public static function clearTable($table){
         return self::query("DELETE from $table");
    }

    public function clearOut(){
        $this->query('DROP DATABASE IF EXISTS '.Config::$database);

        if($this->query('CREATE DATABASE IF NOT EXISTS `'.Config::$database.'` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci; USE `'.Config::$database.'`;')){
            return true;
        }
    }

    
    public $tableStatus = [];
    /**
     * create a new table
     * @param  string  $name table name
     * @param  array   $rows arrow of Row objects
     * @return boolean
     */
    public function createTable($table, array $rows, $drop = true){
        $query = "";
        if($drop) {
            $this->query("DROP TABLE IF EXISTS `".$table."`");
            $query .= "CREATE TABLE ";
        } else {
            $query .= "CREATE TABLE IF NOT EXISTS ";
        }
        $query .= "`".$table."` (";
        $row_arr = [];
        foreach($rows as $key => $row){
             $row_arr[] = $row->toString();
        }

        $query .= implode(", ", $row_arr);
        $query .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $return = $this->query($query);
        $this->tableStatus[] = $return;
        return $return;
    }

    /**
     * covert variables types to sql variable types
     * @author Agne *degaard
     * @param  string $type [[Description]]
     * @return string string
     */
    protected static function types($type){
        $types = [
            'int' => 'int(11)',
            'varchar' => 'varchar(255)',
            'tinyint' => 'tinyint(1)',
            'boolean' => 'tinyint(1)',
        ];

        return array_key_exists($type, $types) ? $types[$type] : $type;
    }

    /**
     * insert many rows to table
     * @param  array  array $data
     * @param  string [$table = null] MySQL table
     * @return boo
     */
    public static function insert(array $data, $table = null){
        $trows = [];
        $placeholder = [];
        $values = [];
        $insertData = [];
        foreach($data[0] as $key => $value){
            $trows[] = $key;
        }

        foreach($data as $nr => $rows){
            $p = [];
            foreach($rows as $key => $row){
                $p[] = ":".$key.$nr;
                $insertData[$key.$nr] = $row;
            }
            $placeholder[] = '('.implode(", ", $p).')';
        }

        $trows = implode(", ", $trows);
        $placeholder = implode(", ", $placeholder);

        $sql = "INSERT INTO {$table} ({$trows}) VALUES {$placeholder}";
        $q = self::query($sql, $insertData);
        $id = self::$db->lastInsertId('id');
        if($id == 0){
          return $q;
        }
        return $id;
    }
    
    /**
     * Update one row in a table
     * @author Agne *degaard
     * @param array $rows       
     * @param string $table      
     * @param array $where      
     * @param string $join = '=' 
     */
    public static function update(array $rows, $table, array $where, $join = '=', $wherejoin = 'AND'){
        $data = [];
        $trows = [];
        $twhere = [];
        foreach($rows as $key => $row){
            $trows[] = "$key $join :key_$key";
            $data["key_$key"] = $row;
        }
        
        foreach($where as $key => $value){
            $twhere[] = "$key $join :where_$key";
            $data["where_$key"] = $value;
        }
        
        $trows = implode(', ', $trows);
        $twhere = implode(" $wherejoin ", $twhere);
        $sql = "UPDATE {$table} SET {$trows} WHERE {$twhere}";
        return self::query($sql, $data);
    }
    
    //updateOrInsert('favorites', ['user_id' => 1, 'recipe_id' => 2], ['rating' => 4]);
    
    public static function updateOrInsert($table, $data = null, $changes){
        $row = self::select(['id'], $table, $data)->fetch();
        
        if(isset($row['id'])){
            self::update($changes, $table, ['id' => $row['id']]);
            return true;
        } else {
            return self::insert([array_merge($data, $changes)], $table);
        }
    }
    
}
