<?php

namespace App\Auth;

use DB, Config;

class Account extends DB{
    
    /**
     * Login User
     * @param  string  $username                   
     * @param  string  $password                   
     * @param  boolean [$remember = false]
     * @return boolean
     */
    public function login($username, $password, $remember = false){
        
        $user = $this->query('SELECT * FROM users WHERE username = :username LIMIT 1', ['username' => $username])->fetch();
        
        if(!password_verify($password, $user['password'])) return false;
        
        if($remember) {
            $cookie = sha1(uniqid());
            $this->query('UPDATE users SET cookie=:c WHERE id = :id', ['c' => $cookie, 'id' => $user['id']]);
            $this->setCookie('remberme', $user['cookie']);
        } else {
            $this->removeCookie('remberme');
        }
        
        $_SESSION['uuid'] = $user['id'];
        
        return true;
    }
    
    /**
     * Register a user
     * @param  string  $username
     * @param  string  $pw1      
     * @param  string  $pw2      
     * @param  string  $mail     
     * @return boolean
     */
    public function register($username, $pw1, $pw2, $mail){
        if($pw1 !== $pw2) return 'passwords does not match';
        
        if($this->query('SELECT username FROM users WHERE username = :username LIMIT 1', ['username' => $username])->rowCount() < 0) return 'Username already taken';
        
        return $this->insert([
            'username'  => $username,
            'password'  => password_hash($pw1),
            'mail'      => $mail
        ], 'users');
    }
    
    /**
     * Set a $_COOKIE param
     * @param string $name
     * @param string $value
     */
    public function setCookie($name, $value){
        setcookie($name, $value, time()+Config::$cookie_time);
    }
    
    /**
     * Remove a $_COOKIE param
     * @param string $name
     */
    public function removeCookie($name){
        unset($_COOKIE[$name]);
        setcookie($name, null, -1);
    }
    
    /**
     * Return if the user is logged in
     * @author Agne *degaard
     * @return boolean
     */
    public static function isLoggedIn(){
        return isset($_SESSION['uuid']);
    }
    
}