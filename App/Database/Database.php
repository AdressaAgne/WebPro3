<?php

namespace App\Database;
use \App\Config as Config;

class Database {
    public static $db;
    public static $table;
    
    /**
     * Init Database connection
     * @private
     * @param string $class Class called that extends Modul in \App\Modul
     */
    public function __construct($class){
        self::$table = explode('\\', $class);
        self::$table = strtolower(self::$table[count(self::$table) - 1]);
        
        try {
            $dns = 'mysql:host='.Config::$db['host'];
            $dns .= ';dbname='.Config::$db['database'];
            self::$db = new PDO($dns, Config::$db['username'], Config::$db['password']);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        } catch (PDOException $e) {
             die('Could not connect to Database'. $e);
        }
    }
    
    /**
     * Bind Values to PDO prepare
     * @param object   &$query
     * @param array  &$args 
     */
    public static function arrayBinder(&$query, &$args) {
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
    protected static function query($sql, $args = null){
        $query = self::$db->prepare($sql);
        if($args !== null){
            self::arrayBinder($query, $args);
        }
        
        return $query->execute() ? $query : false;
    }
    
    /**
     * Select * from class
     * @param  array  [$rows                  = ['*']]
     * @return object Table[Row object] Object
     */
    public static function all($rows = ['*'], $table = null){
        $modul = new Modul(is_null($table) ? static::class : $table = null);
        return new Table($modul::query('SELECT '.implode(', ', $rows).' FROM '.$modul::$table)->fetchAll(), $modul::$table);
    }
    
    /**
     * Select $rows from static::class WHERE $where = $value
     * $rows, $where need to be injected.
     * @param  string [$where = 'id'] [[Description]]
     * @param  string [$value = '1']  [[Description]]
     * @param  array [$rows = ['*']] [[Description]]
     * @return object Table[Row object] object
     */
    public static function where($where = 'id', $value = '1', $rows = ['*'], $table = null){
        $modul = new Modul(is_null($table) ? static::class : $table);
        return new Table($modul::query('SELECT '.implode(', ', $rows).' FROM '.$modul::$table.' WHERE '.$where.' = :value', ['value' => $value])->fetchAll(), $modul::$table);
    }
    
//    public static function one($rows = ['*']){
//        $modul = new Modul(static::class);
//        return new Table();
//    }
    
    /**
     * Delete a row from a table
     * @param  string       [$col = 'id']   col name
     * @param  string       [$val = 0]      Value of col to delete
     * @param  string       [$table = null] Table name
     * @return object/false 
     */
    public static function deleteWhere($col = 'id', $val = 0, $table = null){
        $modul = new Modul(is_null($table) ? static::class : $table);
        return $modul::query("DELETE FROM {$modul::$table} WHERE {$col} = :val", ['val' => $val]);
    }
    
    
    public static function insert(array $data, $table = null){
        $modul = new Modul(is_null($table) ? static::class : $table);
        $rows = [];
        $placeholder = [];
        $values = [];
        foreach($data as $key => $value){
            $rows[] = $key;
            $placeholder[] = ":".$key;
        }
        $rows = implode(",", $rows);
        $placeholder = implode(",", $placeholder);
        return $modul::query("INSERT INTO {$modul::$table} ({$rows}) VALUE({$placeholder})", $data);
    }
    
}