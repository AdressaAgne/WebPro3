<?php

namespace App\Auth;

use DB, Config, User;

class Account extends DB{

    /**
     * Login User
     * @param  string  $username
     * @param  string  $password
     * @param  boolean [$remember = false]
     * @return boolean
     */
    public static function login($username, $password, $remember = false){

        $user = DB::query('SELECT * FROM users WHERE username = :username LIMIT 1', ['username' => $username])->fetch();

        if(!password_verify($password, $user['password'])) return 'These credentials does not match any record in our database';

        if($remember) {
            $cookie = sha1(uniqid());
            DB::query('UPDATE users SET cookie=:c WHERE id = :id', ['c' => $cookie, 'id' => $user['id']]);
            self::setCookie('remberme', $user['cookie']);
        } else {
            self::removeCookie('remberme');
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
    public static function register($username, $pw1, $pw2, $mail){
        if($pw1 != $pw2) return 'passwords does not match';

        
        if(DB::query('SELECT username FROM users WHERE username = :username LIMIT 1', ['username' => $username])->rowCount() > 0) return 'Username already taken';

        return DB::insert([[
            'username'  => $username,
            'password'  => password_hash($pw1, PASSWORD_DEFAULT),
            'mail'      => $mail,
        ]], 'users');

    }
    
    public static function logout(){
        self::removeCookie('remberme');
        session_destroy();
    }

    /**
     * Set a $_COOKIE param
     * @param string $name
     * @param string $value
     */
    public static function setCookie($name, $value){
        setcookie($name, $value, time()+Config::$cookie_time);
    }

    /**
     * Remove a $_COOKIE param
     * @param string $name
     */
    public static function removeCookie($name){
        unset($_COOKIE[$name]);
        setcookie($name, null, -1);
    }

    /**
     * Return if the user is logged in
     * @return boolean
     */
    public static function isLoggedIn(){
        return isset($_SESSION['uuid']);
    }

    public static function changePassword(User $user, $pw, $newPw, $newpw2){
        if($newPw !== $newpw2) return 'The new password does not match';
        
        if(!password_verify($pw, $user->password)) return 'Old Password is wrong';
        
        $msg = DB::update(['password' => password_hash($newPw, PASSWORD_DEFAULT)], 'users', ['id' => $user->id]);
        
        return $msg;
    }//changePassword

    public function changeEmail($newMail){
      return 0;
    }//changeEmail()

    public static function get_id(){
        return (isset($_SESSION['uuid']) ? $_SESSION['uuid'] : false);
    }
}
